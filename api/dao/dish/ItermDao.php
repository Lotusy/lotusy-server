<?php
class ItermDao extends ItermDaoGenerated {

    const TYPE_CUISINE = 'CUISINE';
    const TYPE_KEYWORD = 'KEYWORD';
    const TYPE_ALERT = 'ALERT';
    const TYPE_USERRANK = 'USERRANK';
    const TYPE_INFOGRAPH = 'INFOGRAPH';

// =============================================== public function =================================================

    public static function getTypeLanguageCodes($type, $language='en') {
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

// ============================================ override functions ==================================================

}
?>