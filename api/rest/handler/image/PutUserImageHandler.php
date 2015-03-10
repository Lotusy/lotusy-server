<?php
class PutUserImageHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        global $base_host, $base_uri, $image_dir;

        $userId = $this->getUserId();

        $fileName = 'user_'.date('YmdHis').'_'.$userId.'_'.rand (0, 10000).'.png';

        $imageDate = Utility::getRawRequestData();
        file_put_contents($image_dir.$fileName, $imageDate);

        $userImage = new UserImageDao();
        $userImage->setUserId($userId);
        $userImage->setName($fileName);
        $userImage->setPath($image_dir);

        if (UserImageDao::deleteUserImages($userId)) {
            $userImage->save();
        }

        $atReturn['status'] = 'success';

        return $atReturn;
    }
}
?>