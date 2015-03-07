<?php
class BusinessDao extends BusinessDaoGenerated {

    public static $TYPEARRAY = array(
        'yelp' => 1,
        'dianping' => 2
    );

    public static $TYPEARRAYREV = array(
        1 => 'yelp',
        2 => 'dianping'
    );

// =========================================================================================================== public

    public static function getName($language) {
        $rv = '';

        switch ($language) {
            case 'tw':
                $rv = $this->getNameTw();
                break;
            case 'zh':
                $rv = $this->getNameZh();
                break;
            default:
                $rv = $this->getNameEn();
        }

        return $rv;
    }

    public static function getBusinessIdsByName($name, $field) {
        $builder = new QueryMaster();
        $res = $builder->select($bid)->where($column, '%'.$name.'%', 'LIKE')->findList();

        $atReturn = array();
        foreach ($res as $row) {
            array_push($atReturn, $row[$bid]);
        }

        return $atReturn;
    }

    public static function isEnNameExist($name) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table)
                       ->where('en_name', $name)
                       ->find();

        return $res['count']>0;
    }

    public static function isExternalIdExist($externalId, $externalType) {
        $builder = new QueryMaster();
        $res = $builder->select('external_type', self::$table)
                       ->where('external_id', $externalId)
                       ->findList();

        foreach ($res as $row) {
            if ($row['external_type']==$externalType) {
                return true;
            }
        }

        return false;
    }


    public static function getBusinessIdsWithin($lat, $lng, $radius, $start, $size, $isMiles=false) {
        $earthRadius = $isMiles ? 3959 : 6371;
        $latRadius = deg2rad($lat);

        $p1 = "cos( $latRadius ) * cos( radians(lat) ) * cos( radians(lng - $lng) )";
        $p2 = "sin( $latRadius ) * sin( radians(lat) )";

        $builder = new QueryMaster();
        $res = $builder->select("id, ( $earthRadius * acos( $p1 + $p2 ) ) AS distance", self::$table)
                        ->having('distance', $radius, '<')
                        ->order('distance')
                        ->limit($start, $size)
                        ->findList();

        return $res;
    }

// ============================================ override functions ==================================================

    protected function beforeInsert() {
        $this->setVerified('N');
    }

    public function toArray() {
        $atReturn = parent::toArray(array('hours'));
        $atReturn['hours'] = json_decode($this->getHours(), true);
        return $atReturn;
    }
}
?>