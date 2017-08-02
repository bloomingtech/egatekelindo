<?php

class ComponentBrandDiscount extends ComponentBrandDiscountBase
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
        
        public function getValue()
        {
            return $this->value_1 . ' - ' . $this->value_2 . ' - ' . $this->value_3 . ' - ' . $this->value_4 . ' - ' . $this->value_5 ;
        }
}