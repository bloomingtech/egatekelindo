<?php

class SaleOrderDetail extends SaleOrderDetailBase {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getTotal() {
        return $this->unit_price * $this->quantity;
    }

    public function getPercentage() {
        return $this->getTotal() / $this->saleOrderHeader->getSubTotal() * 100;
    }

}