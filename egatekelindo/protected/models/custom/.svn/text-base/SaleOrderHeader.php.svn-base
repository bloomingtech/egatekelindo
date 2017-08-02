<?php

class SaleOrderHeader extends SaleOrderHeaderBase {
    const CN_CONSTANT = 'SO';

    const ORDER_STATUS_CONST_1 = 'Real';
    const ORDER_STATUS_CONST_2 = 'Variation Order';
    const ORDER_STATUS_CONST_3 = 'Modifikasi';
    const ORDER_STATUS_CONST_4 = 'Servis';

    public $newCustomer;
    public $address;
    public $tax_number;
    public $ordinal;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getTotal() {
        return $this->value * $this->downpayment / 100;
    }

    public function getCalculatedTax() {
        if ($this->is_tax == 1)
            return $this->total * 0.1;
        else
            return 0;
    }

    public function getGrandTotalDownPayment() {
        return $this->total + $this->calculatedTax;
    }

    public function getSubTotal() {
        $total = 0;

        foreach ($this->saleOrderDetails as $detail) {
            if ($detail->is_inactive == 0)
                $total+= $detail->total;
        }

        return $total;
    }

    public function getDiscountValue() {
        return $this->subTotal * $this->discount / 100;
    }

    public function getPpn() {
        if ($this->is_tax == 1)
            return ($this->subTotal - $this->discountValue) * 0.1;
        else
            return 0;
    }

    public function getGrandTotal() {
        return $this->subTotal + $this->ppn - $this->discountValue;
    }

    public function getValueWithoutTax() {
        if ($this->is_tax == 1)
            return $this->value / 1.1;
        else
            return $this->value;
    }

    public function getOrderStatus() {
        if ($this->order_status == 1)
            return SaleOrderHeader::ORDER_STATUS_CONST_1;
        else if ($this->order_status == 2)
            return SaleOrderHeader::ORDER_STATUS_CONST_2;
        else if ($this->order_status == 3)
            return SaleOrderHeader::ORDER_STATUS_CONST_3;
        else if ($this->order_status == 4)
            return SaleOrderHeader::ORDER_STATUS_CONST_4;
    }

    public function getNumber($cnConstant = '') {

        return sprintf('%s-%02d-%02d-%01d-%04d', $cnConstant, $this->cn_year, $this->cn_month, $this->is_tax ? 1 : 0, $this->cn_ordinal);
    }

    public function searchBySaleInvoice() {
        $criteria = new CDbCriteria;

        $criteria->condition = "t.id NOT IN (SELECT sale_order_header_id FROM tblet_sale_invoice_header WHERE is_inactive = 0)";

        $criteria->compare('t.cn_ordinal', $this->cn_ordinal);
        $criteria->compare('t.cn_month', $this->cn_month);
        $criteria->compare('t.cn_year', $this->cn_year);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.is_inactive', 0);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function searchBySaleReturn() {
        $criteria = new CDbCriteria;

        $criteria->condition = "t.id NOT IN (SELECT sale_order_header_id FROM tblet_sale_return_header WHERE is_inactive = 0)";

        $criteria->compare('t.cn_ordinal', $this->cn_ordinal);
        $criteria->compare('t.cn_month', $this->cn_month);
        $criteria->compare('t.cn_year', $this->cn_year);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.is_inactive', 0);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function searchByPartList() {
        $criteria = new CDbCriteria;

        $criteria->condition = "t.id NOT IN (SELECT sale_order_header_id FROM tblet_part_list_header WHERE is_inactive = 0)";

        $criteria->compare('t.cn_ordinal', $this->cn_ordinal);
        $criteria->compare('t.cn_month', $this->cn_month);
        $criteria->compare('t.cn_year', $this->cn_year);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.is_inactive', 0);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function searchByDelivery() {
        $criteria = new CDbCriteria;

        $criteria->condition = "t.id NOT IN (SELECT sale_order_header_id FROM tblet_delivery_header WHERE is_inactive = 0)";

        $criteria->compare('t.cn_ordinal', $this->cn_ordinal);
        $criteria->compare('t.cn_month', $this->cn_month);
        $criteria->compare('t.cn_year', $this->cn_year);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.is_inactive', 0);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function searchByWorkOrderProduction() {
        $criteria = new CDbCriteria;

        $criteria->condition = "t.id NOT IN (SELECT sale_order_header_id FROM tblet_work_order_production_header WHERE is_inactive = 0)";

        $criteria->compare('t.cn_ordinal', $this->cn_ordinal);
        $criteria->compare('t.cn_month', $this->cn_month);
        $criteria->compare('t.cn_year', $this->cn_year);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.is_inactive', 0);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function searchBySubcon() {
        $criteria = new CDbCriteria;

        $criteria->condition = "t.id NOT IN (SELECT sale_order_header_id FROM tblet_subcon_request_header WHERE is_inactive = 0)";

        $criteria->compare('t.cn_ordinal', $this->cn_ordinal);
        $criteria->compare('t.cn_month', $this->cn_month);
        $criteria->compare('t.cn_year', $this->cn_year);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.is_inactive', 0);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function searchByRequirement() {
        $criteria = new CDbCriteria;

        $criteria->condition = "t.id IN
        (SELECT sale_order_header_id FROM tblet_budgeting_header budgetingHeader WHERE 
	budgetingHeader.id IN (SELECT budgeting_header_id FROM tblet_work_order_drawing_header drawingHeader WHERE 
		drawingHeader.id IN (SELECT work_order_drawing_header_id FROM tblet_work_order_production_header)))";

        $criteria->compare('t.cn_ordinal', $this->cn_ordinal);
        $criteria->compare('t.cn_month', $this->cn_month);
        $criteria->compare('t.cn_year', $this->cn_year);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.is_inactive', 0);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}