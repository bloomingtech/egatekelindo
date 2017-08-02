<?php

class EstimationBrandDiscount extends EstimationBrandDiscountBase {
    const DISCOUNT = 0;
    const CURRENCY = 1;
    const DISCOUNT_LITERAL = '%';
    const CURRENCY_LITERAL = 'IDR';

    const TRUE_VALUE = '0';
    const FALSE_VALUE = '1';
    const PLUS_LITERAL = '+';
    const MINUS_LITERAL = '-';
    
    public $currentRate = 0;
    public $currency_id = NULL;
    public $isPrimary = 0;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getIsDeduction1() {
        return ($this->is_deduction_1) ? self::MINUS_LITERAL : self::PLUS_LITERAL;
    }

    public function getIsDeduction2() {
        return ($this->is_deduction_2) ? self::MINUS_LITERAL : self::PLUS_LITERAL;
    }

    public function getIsDeduction3() {
        return ($this->is_deduction_3) ? self::MINUS_LITERAL : self::PLUS_LITERAL;
    }

    public function getIsDeduction4() {
        return ($this->is_deduction_4) ? self::MINUS_LITERAL : self::PLUS_LITERAL;
    }

    public function getIsDeduction5() {
        return ($this->is_deduction_5) ? self::MINUS_LITERAL : self::PLUS_LITERAL;
    }

    public function getType1() {
        return ($this->discount_type_1) ? self::CURRENCY_LITERAL : self::DISCOUNT_LITERAL;
    }

    public function getType2() {
        return ($this->discount_type_2) ? self::CURRENCY_LITERAL : self::DISCOUNT_LITERAL;
    }

    public function getType3() {
        return ($this->discount_type_3) ? self::CURRENCY_LITERAL : self::DISCOUNT_LITERAL;
    }

    public function getType4() {
        return ($this->discount_type_4) ? self::CURRENCY_LITERAL : self::DISCOUNT_LITERAL;
    }

    public function getType5() {
        return ($this->discount_type_5) ? self::CURRENCY_LITERAL : self::DISCOUNT_LITERAL;
    }
    
    public function setPrimary() {
        $this->isPrimary = $this->componentBrandDiscount->is_primary ;
    }

}
