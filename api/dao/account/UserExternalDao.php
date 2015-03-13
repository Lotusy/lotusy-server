<?php
class UserExternalDao extends UserExternalDaoGenerated {

    public static $TYPEARRAY = array(
        'facebook' => 1,
        'weibo' => 2
    );

    public static $TYPEARRAYREV = array(
        1 => 'facebook',
        2 => 'weibo'
    );

// ========================================================================================== public

    public static function getUserIdByExternalTypeAndReference($externalType, $externalRef) {
        if (!isset(self::$TYPEARRAY[$externalType])) {
            return 0;
        }

        $type = self::$TYPEARRAY[$externalType];

        $builder = new QueryMaster();
        $res = $builder->select('user_id', self::$table)
                        ->where('reference', $externalRef)
                        ->where('type', $type)
                       ->find();

        if (isset($res) && $res) {
            return $res['user_id'];
        }

        return 0;
    }

    public static function isExternalRefExist($externalType, $externalRef) {
        if (!isset(self::$TYPEARRAY[$externalType])) {
            return false;
        }

        $type = self::$TYPEARRAY[$externalType];

        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table)
                        ->where('external_ref', $externalRef)
                        ->where('external_type', $type)
                        ->find();

        return $res['count']>0;
    }

    public static function removeExternalLink($externalType, $userId) {
        if (!isset(self::$TYPEARRAY[$externalType])) {
            return false;
        }

        $type = self::$TYPEARRAY[$externalType];

        $builder = new QueryMaster();
        $res = $builder->delete(self::$table)
                       ->where('external_ref', $externalRef)
                       ->where('user_id', $userId)
                       ->query();
        return $res;
    }

    public static function getUserExternalLinks($userId) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                       ->where('user_id', $userId)
                       ->findList();

        return self::makeObjectsFromSelectListResult($res, 'UserExternalDao');
    }

// ======================================================================================== override

    protected function beforeInsert() {
        $this->setCreateTime(date('Y-m-d H:i:s'));
    }
    
}
?>