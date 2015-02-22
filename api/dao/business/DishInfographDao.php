<?php
class DishInfographDao extends DishInfographDaoGenerated {

// =============================================== public function =================================================

    public static function getDishInfograph($dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('AVG(item_value) as item_value, 
                                 AVG(portion_size) as portion_size, 
                                 AVG(presentation) as presentation, 
                                 AVG(uniqueness) as uniqueness', self::$table)
                       ->where('dish_id', $dishId)
                       ->find();
        return $res;
    }

    public static function getUserDishInfograph($dishId, $userId) {
        $builder = new QueryMaster();
        $res = $builder->select('item_value, portion_size, presentation, uniqueness', self::$table)
                       ->where('dish_id', $dishId)
                       ->where('user_id', $userId)
                       ->find();
        return $res;
    }

    public static function getUserDishInfographDao($dishId, $userId) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                       ->where('dish_id', $dishId)
                       ->where('user_id', $userId)
                       ->find();

		$rv = self::makeObjectFromSelectResult($res, 'DishInfographDao');
        if (!isset($rv)) {
        	$rv = new DishInfographDao();
        }

        return $rv;
    }

// ============================================== override function ================================================

    protected function beforeInsert() {
    	$itemValue = $this->getItemValue();
    	$portionSize = $this->getPortionSize();
    	$presentation = $this->getPresentation();
    	$uniqueness = $this->getUniqueness();
    
    	if (!isset($itemValue)) { $this->setItemValue(0); }
    	if (!isset($portionSize)) { $this->setPortionSize(0); }
    	if (!isset($presentation)) { $this->setPresentation(0); }
    	if (!isset($uniqueness)) { $this->setUniqueness(0); }
    }
}
?>