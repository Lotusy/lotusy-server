<?php
class GetDishProfileImageLinksHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        global $base_host, $base_uri;

        $start = empty($_GET['start']) ? 0 : $_GET['start'];
        $size = empty($_GET['size']) ? 0 : $_GET['size'];

        $imageDaos = DishImageDao::getImagesByDishId($params['dishid'], $start, $size);

        $links = array();
        foreach ($imageDaos as $imageDao) {
            $link = $base_host.$base_uri.'/image/dish/'.$params['dishid'].'/user/'.$imageDao->getUserId().'/display';
            $links[$imageDao->getId()] = $link;
        }

        return array('status'=>'success', 'links'=>$links);
    }
}
?>