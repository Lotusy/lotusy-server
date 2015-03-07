<?php
class AccessTokenDao extends AccessTokenDaoGenerated {

    const AccessTokenDuration = 15552000;

// ========================================================================================== public

    public static function retriveDaoByAccessToken($accessToken) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)->where('access_token', $accessToken)->find();

        return self::makeObjectFromSelectResult($res, 'AccessTokenDao');
    }

    public function expired() {
        return time() > $this->getExpiresTime();
    }

// ======================================================================================== override

    protected function beforeInsert() {
        $this->setExpiresTime(self::AccessTokenDuration+time());
    }
}
?>