<?php
class TokenAuthenticationHandler extends UnauthorizedRequestHandler {

    public function handle($params) {
        $json = Utility::getJsonRequestData();
        $json['external_type'] = $params['type'];

        $validator = new TokenAuthenticationValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        if ($params['type']=='facebook') {
            $request = new GetFacebookTokenInfoRequest($json['access_token']);
            $info = $request->execute();
        }
        else if ($params['type']=='weibo') {
            $request = new GetWeiboTokenInfoRequest($json['access_token']);
            $info = $request->execute();
        }

        if ($info['status']=='success') {
            $userId = UserExternalDao::getUserIdByExternalTypeAndReference($params['type'], $info['id']);
            if ($userId>0) {
                $user = new UserDao($userId);
            } else {
                $user = new UserDao();
                $user->setNickname($info['nickname']);
                $user->setUsername($info['username']);
                $user->setGender($info['gender']);
                if ($user->save()) {
                    $externalLink = new UserExternalDao();
                    $type = UserExternalDao::$TYPEARRAY[$params['type']];
                    $externalLink->setType($type);
                    $externalLink->setReference($info['id']);
                    $externalLink->setUserId($user->getId());
                    $externalLink->setProfilePic($info['profile_pic']);
                    $externalLink->save();
                }
            }

            $accessToken = new AccessTokenDao();
            $accessToken->setUserId($user->getId());
            $accessToken->setAccessToken(Utility::generateToken());
            $accessToken->setRefreshToken(Utility::generateToken());
            $accessToken->save();
            Logger::info('Create Token '.json_encode($accessToken->toArray()));
    
            $atReturn = array();
            $atReturn['status'] = 'success';
            $atReturn['user_id'] = $user->getId();
            $atReturn['access_token'] = $accessToken->getAccessToken();
            $atReturn['refresh_token'] = $accessToken->getRefreshToken();
            $atReturn['token_type'] = 'Bearer';
            $atReturn['expires_in'] = $accessToken->getExpiresTime() - time();
        } else {
            header('HTTP/1.0 400 Bad Request');
            $atReturn = array('status'=>'error', 'description'=>'invalid_access_token');
        }

        return $atReturn;
    }
}
?>