<?php

class BudgetingBrandDiscount extends BudgetingBrandDiscountBase {

    public $currentRate = 0;
    public $currency_id = NULL;
    public $isPrimary = 0;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getIsPrimary() {
        return $this->componentBrandDiscount->is_primary;
    }

    public function getTypeString($type) {
        if ($type == 1)
            return 'X';
        else if ($type == 2)
            return '/';
        else if ($type == 3)
            return '-';
		else if ($type == 4)
            return '+';
    }
}