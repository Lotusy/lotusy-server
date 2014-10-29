<?php
class AdminDao extends AdminDaoGenerated {

	const TYPE_CUISINE = 'CUISINE';

// =============================================== public function =================================================

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