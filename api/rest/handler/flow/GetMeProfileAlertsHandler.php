<?php
class GetMeProfileAlertsHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $language = $this->getLanguage();
        $userId = $this->getUserId();

        $user = User::alloc()->initWithId($userId);

        $userCodes = $user->getActiveAlertCodes();
        $allCodes = ItermDao::getTypeLanguageCodeDescriptionMap(ItermDao::TYPE_ALERT, $language);

        $descriptions = array();
        foreach ($allCodes as $code=>$description) {
            $isActive = in_array($code, $userCodes);
            $descriptions[] = array('code'=>$code,
                                    'active'=>in_array($code, $userCodes),
                                    'description'=>$description);
        }

        $response = array('status'=>'success');
        $response['alters'] = $descriptions;

        return $response;
    }
}
?>