<?php
class GetUserSignatureImageLinksHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        global $base_host, $base_uri;

        $imageDaos = SignatureImageDao::getUserSignatures($params['userid']);

        $links = array();
        foreach ($imageDaos as $imageDao) {
            $link = $base_host.$base_uri.'/image/signature/'.$imageDao->getId().'/user/'.$params['userid'].'/display';
            $links[$imageDao->getId()] = $link;
        }

        return array('status'=>'success', 'links'=>$links);
    }
}
?>