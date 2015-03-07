<?php
class KeywordDao extends KeywordDaoGenerated {

// =============================================== public function =================================================

    public static function getAllKeywordsColor() {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)->findList();

        $rv = array();
        foreach ($res as $row) {
            $rv[$row['code']] = $row['color'];
        }
        return $rv;
    }

// ============================================ override functions ==================================================

}
?>