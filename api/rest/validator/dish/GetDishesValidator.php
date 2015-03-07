<?php
class GetDishesValidator extends Validator {

    private $dishIds = 0;

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $valid = $this->nonEmpty($json, 'missing request body');

        if ($valid) {
            $this->dishIds = explode(',', $json['dishids']);
            $valid = count($this->dishIds)>0;
            if (!$valid) {
                header('HTTP/1.0 400 Bad Request');
                $this->setErrorMessage('invalid_dish_ids');
            }
        }

        if ($valid) {
            foreach ($this->dishIds as $dishId) {
                $valid = $valid && is_numeric($dishId) && $dishId>0;
                if (!$valid) { 
                    header('HTTP/1.0 400 Bad Request');
                    $this->setErrorMessage('invalid_dish_id_format');
                }
            }
        }

        return $valid;
    }

    public function getDishIds() {
        return $this->dishIds;
    }
}
?>