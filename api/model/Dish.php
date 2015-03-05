<?php
class Dish extends Model {

	public function getProfileImageLinks() {
		$rv = array();

		$imageDaos = DishImageDao::getImagesByDishId($this->getId());

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

	public function getPopularityArray($userId, $followingIds) {
		$rv = array();
		$likes = DishUserLikeDao::getDishLikedCount($this->getId());
		$total = DishUserLikeDao::getDishCount($this->getId());
		$rv['count'] = $total;
		if ($total>0) {
			$rv['percent'] = round(100*$likes/$total);
		}
		$dao = DishUserLikeDao::getUserResponseOnDish($userId, $this->getId());
		if (isset($dao)) {
			$rv['like'] = $dao->getIsLike()=='Y';
		}
		$userIds = DishUserLikeDao::getDishUsersInRange($followingIds, $this->getId(), 2);
		$userDaos = UserDao::getRange($userIds);
		$rv['friends'] = array();
		foreach ($userDaos as $userDao) {
			$rv['friends'][] = $userDao->getNickname();
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

	public function getUserKeywordArray($userId, $language='en') {
		$rv = array();

		$terms = ItermDao::getTypeLanguageCodes(ItermDao::TYPE_KEYWORD, $language);
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
				$keyword['count'] = 0;
			}
			$keyword['self'] = in_array($code, $codes);
			$rv[] = $keyword;
		}

		return $rv;
	}

// =============================================================== getter/setter

	public function getBusinessId() {
		return $this->dao->getBusinessId();
	}

// ==================================================================== override

    public function init() {
    	$this->dao = new DishDao();	
    }

    public function init_with_id($id) {
    	$this->dao = new DishDao($id);	
    }
}
?>