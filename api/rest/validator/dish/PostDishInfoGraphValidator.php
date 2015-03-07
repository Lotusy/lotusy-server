<?php
class PostDishInfoGraphValidator extends Validator {

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $valid = $this->nonEmpty($json, 'missing request body');

        if ($valid) {
            $valid= !empty($json['item_value']) || 
                    !empty($json['portion_size']) || 
                    !empty($json['presentation']) || 
                    !empty($json['uniqueness']);
        }

        return $valid;
    }
}
?>