<?php
class UserAlertDao extends UserAlertDaoGenerated {

    public static function getUserAlertCodes($userId) {
        $builder = new QueryMaster();
        $res = $builder->select('keyword_code', self::$table)
                        ->where('user_id', $userId)
                        ->findList();
        $codes = array();
        foreach ($res as $row) {
            array_push($codes, $row['keyword_code']);
        }

        return $codes;
    }

    public static function deleteUserAlert($userId, $code) {
        $builder = new QueryMaster();
        $res = $builder->delete(self::$table)
                        ->where('user_id', $userId)
                        ->where('keyword_code', $code)
                        ->query();
        return $res;
    }

    public static function addUserAlert($userId, $code) {
        $dao = new UserAlertDao();
        $dao->setKeywordCode($code);
        $dao->setUserId($userId);
        return $dao->save();
    }
}
?>