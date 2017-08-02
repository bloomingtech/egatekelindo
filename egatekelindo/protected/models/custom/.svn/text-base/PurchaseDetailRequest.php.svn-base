<?php

class PurchaseDetailRequest extends PurchaseDetailRequestBase {

    public $quantity_requested; 
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getUnitPriceAfterDiscount() {
        return ((($this->unit_price * (1 - $this->discount_1 / 100)) * (1 - $this->discount_2 / 100)) * (1 - $this->discount_3 / 100)) * (1 - $this->discount_4 / 100);
    }

    public function getTotal() {
        return $this->quantity * $this->weight * $this->unit_price;
    }

    public function getTotalAfterDiscount() {
        return ((($this->total * (1 - $this->discount_1 / 100)) * (1 - $this->discount_2 / 100)) * (1 - $this->discount_3 / 100)) * (1 - $this->discount_4 / 100);
    }

}