<?php
class Dish extends Model {

	private $business = null;

    public function getProfileImageLinks() {
        $rv = array();

        $imageDaos = DishImageDao::getImagesByDishId($this->getId(), 0, 20);

        global $base_host, $base_uri;

        $count = 1;
        foreach ($imageDaos as $imageDao) {
            if ($imageDao->getIsDefault() == 'Y') {
                $index = 0;
            } else {
                $index = $count;
                $count++;
            }
            $rv[$index] = $base_host.$base_uri.'/image/dish/'.$this->getId().'/user/'.$imageDao->getUserId().'/display';
        }

        return $rv;
    }

    public function getPopularityArray($userId, $followingIds, $language='en') {
        $rv = array();
        $likes = DishUserLikeDao::getDishLikedCount($this->getId());
        $total = DishUserLikeDao::getDishCount($this->getId());
        $rv['total_count'] = $total;
        $rv['like_count'] = $likes;
        if ($total>0) {
            $rv['percent'] = round(100*$likes/$total);
        }

        $userRelation = $this->getUserRelation($userId);
        $rv = $rv + $userRelation;

        $userIds = DishUserLikeDao::getDishUsersInRange($followingIds, $this->getId(), 2, true);
        $userDaos = UserDao::getRange($userIds);
        $rv['friends'] = array();
        foreach ($userDaos as $userDao) {
            $rv['friends'][] = $userDao->getNickname();
        }
        $business = $this->getBusiness();
        $rv['business'] = $business->getName($language);

        return $rv;
    }

    public function getUserRelation($userId) {
    	$rv = array();

    	$likeDao = DishUserLikeDao::getUserResponseOnDish($userId, $this->getId());
    	if (isset($likeDao)) {
    		$rv['like'] = $likeDao->getIsLike()=='Y';
    		$rv['type'] = 'collection';
    	} else if (DishActivityDao::isDishHitlisted($this->getId(), $userId)) {
    		$rv['like'] = null;
    		$rv['type'] = 'hitlist';
    	} else {
    		$rv['like'] = null;
    		$rv['type'] = null;
    	}

    	return $rv;
    }

    public function getInfoGraphArray() {
        $rv = array();
        $infograph = DishInfographDao::getDishInfograph($this->getId());
        foreach ($infograph as $key=>$value) {
            $rv[$key] = round($value);
        }
        return $rv;
    }

    public function getUserInfoGraphArray($userId) {
        $rv = array();
        $infograph = DishInfographDao::getUserDishInfograph($this->getId(), $userId);
        foreach ($infograph as $key=>$value) {
            $rv[$key] = round($value);
        }
        return $rv;
    }

    public function getUserKeywordArray($userId, $language='en') {
        $rv = array();

        $terms = ItermDao::getTypeLanguageCodeDescriptionMap(ItermDao::TYPE_KEYWORD, $language);
        $color = KeywordDao::getAllKeywordsColor();
        $total = DishUserKeywordDao::getDishKeywordsCount($this->getId());
        $codes = DishUserKeywordDao::getUserDishKeywords($userId, $this->getId());
        foreach ($terms as $code=>$discription) {
            $keyword = array();
            $keyword['code'] = $code;
            $keyword['color'] = $color[$code];
            if (isset($total[$code])) {
                $keyword['count'] = $total[$code];
            } else {
                continue;
            }
            $keyword['self'] = in_array($code, $codes);
            $rv[] = $keyword;
        }

        return $rv;
    }

    public static function getDishesDetails($dishIds, $language='en') {
        $dishDaos = DishDao::getRange($dishIds);

        $businessIds = array();
        foreach ($dishDaos as $dishDao) {
            $businessIds[] = $dishDao->getBusinessId();
        }

        $businessDaos = BusinessDao::getRange($businessIds, true);

        global $base_host,$base_url;
        $rv = array();
        foreach ($dishDaos as $dishDao) {
            $businessDao = $businessDaos[$dishDao->getBusinessId()];
            $rv[] = array('dish_id' => $dishDao->getId(),
                          'name' => $dishDao->getName($language),
                          'business' => $businessDao->getName($language),
                          'image' => $base_host.$base_url.'/image/dish/'.$dishDao->getId().'/user/'.$dishDao->getId().'/display');
        }

        return $rv;
    }


    public function getBusiness() {
    	if (!isset($this->business)) {
    		$this->business = Business::alloc()->initWithId($this->getBusinessId());
    	}

    	return $this->business;
    }


// =============================================================== getter/setter

    public function getBusinessId() {
        return $this->dao->getBusinessId();
    }
    public function getName($language) {
        return $this->dao->getName($language);
    }

// ==================================================================== override

    public function init() {
        $this->dao = new DishDao();

        return $this; 
    }

    public function initWithId($id) {
        $this->dao = new DishDao($id);

        return $this;  
    }
}
?>