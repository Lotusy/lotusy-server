<?php
class DisplayDishUserImageHandler extends UnauthorizedRequestHandler {

    public function handle($params) {
        $dishUserImageDao = DishUserImageDao::getUserDishImage($params['userid'], $params['dishid']);
        if (isset($dishUserImageDao)) {
            $dishImage = new DishImageDao($dishUserImageDao->getImageId());
            if (!isset($dishImage)) {
                $dishImage = DishImageDao::getDishDefaultImage($params['dishid']);
            }
        } else {
            $dishImage = DishImageDao::getDishDefaultImage($params['dishid']);
        }
        $path = $dishImage->getPath();
        $name = $dishImage->getName();
        $filename = $path.$name;

        Logger::info('file name - '.$filename);
        header('Content-Type: image/png');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);

        return;
    }
}
?>