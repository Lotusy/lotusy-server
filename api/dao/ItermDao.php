<?php
class ItermDao extends ItermDaoGenerated {

    const TYPE_CUISINE = 'CUISINE';
    const TYPE_KEYWORD = 'KEYWORD';
    const TYPE_ALERT = 'USERALERT';
    const TYPE_USERRANK = 'USERRANK';
    const TYPE_INFOGRAPH = 'INFOGRAPH';

// =============================================== public function =================================================

    public static function getTypeLanguageCodeDescriptionMap($type, $language='en') {
        $builder = new QueryMaster();
        $rows = $builder->select('code, description', self::$table)
                        ->where('language', $language)
                        ->where('type', $type)
                        ->findList();

        $descriptions = array();
        if ($rows) {
            foreach ($rows as $row) {
                $descriptions[$row['code']] = $row['description'];
            }
        }

        return $descriptions;
    }

    public static function getCodeDescriptionArray($codes, $type, $language='en') {
        $builder = new QueryMaster();
        $rows = $builder->select('code, description', self::$table)
                        ->where('language', $language)
                        ->where('type', $type)
                        ->in('code', $codes)
                        ->findList();

        $descriptions = array();
        if ($rows) {
            foreach ($rows as $row) {
                $descriptions[$row['code']] = $row['description'];
            }
        }

        return $descriptions;
    }

    public static function getDescriptionWithCodeAndType($code, $type, $language='en') {
        $builder = new QueryMaster();
        $res = $builder->select('description', self::$table)
                       ->where('code', $code)
                       ->where('type', $type)
                       ->where('language', $language)
                       ->find();

        return $res['description'];
    }

    public static function getUserRanksMap($language='en') {
        $ranks = ItermDao::getTypeLanguageCodeDescriptionMap(ItermDao::TYPE_USERRANK, $language);

        $rv = array();
        foreach (USER::$RANKS as $code=>$range) {
            $rv[$ranks[$code]] = $range[1];
        }

        return $rv;
    }

// ============================================ override functions ==================================================

}
?>