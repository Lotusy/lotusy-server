<?php
class GetMeProfileSettingHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $language = $this->getLanguage();
        $userId = $this->getUserId();

        $user = User::alloc()->initWithId($userId);

        $name = $user->getNickname();

        $externalLinks = $user->getExternalLinkProfiles();

        $alertCodes = $user->getActiveAlertCodes();
        $descriptions = ItermDao::getCodeDescriptionArray($alertCodes, ItermDao::TYPE_ALERT, $language);

        $response = array('status'=>'success');
        $response['name'] = $name;
        $response['link_accounts'] = $externalLinks;
        $response['alerts'] = $descriptions;

        return $response;
    }
}
?>