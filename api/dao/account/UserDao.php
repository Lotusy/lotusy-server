<?php
class UserDao extends UserDaoGenerated {

    const RANK_00 = '5000';
    const RANK_01 = '5001';
    const RANK_02 = '5002';
    const RANK_03 = '5003';
    const RANK_04 = '5004';
    const RANK_05 = '5005';
    const RANK_06 = '5006';
    const RANK_07 = '5007';
    const RANK_08 = '5008';
    const RANK_09 = '5009';
    const RANK_10 = '5010';

// ========================================================================================== public


    public static function getUserIdsFromNickName($nickname) {
        $builder = new QueryMaster();
        $res = $builder->select('id', self::$table)->where('nickname', '%'.$nickname.'%', 'LIKE')->findList();

        $atReturn = array();
        foreach ($res as $row) {
            array_push($atReturn, $row['id']);
        }

        return $atReturn;
    }

// ======================================================================================== override

    protected function beforeInsert() {
        $this->setSuperuser('N');
        $this->setBlocked('N');
        $this->setRank(self::RANK_01);
        $this->setLastLogin(date('Y-m-d H:i:s'));
    }
}
?>