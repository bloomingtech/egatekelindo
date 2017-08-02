<?php

class PurchaseRequestHeader extends PurchaseRequestHeaderBase {
    const CN_CONSTANT = 'PREQ';

//	const CN_CONSTANT_SERVICE = 'QOTS';
//	const CN_CONSTANT_PRODUCT = 'QOTP';

    const SERVICE = 1;
    const PRODUCT = 0;

    const SERVICE_LITERAL = 'Jasa';
    const PRODUCT_LITERAL = 'Barang';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getTransactionType() {
        return ($this->is_service) ? self::SERVICE_LITERAL : self::PRODUCT_LITERAL;
    }

    public function getTotalQuantityComponent() {
        $total = 0;

        foreach ($this->purchaseRequestDetailComponents as $detail) {
            if ($detail->is_inactive == 0)
                $total+= $detail->quantity;
        }

        return $total;
    }

    public function getTotalWeightComponent() {
        $total = 0;

        foreach ($this->purchaseRequestDetailComponents as $detail) {
            if ($detail->is_inactive == 0)
                $total+= $detail->weight;
        }

        return $total;
    }

    public function getTotalQuantityService() {
        $total = 0;

        foreach ($this->purchaseRequestDetailServices as $detail) {
            if ($detail->is_inactive == 0)
                $total+= $detail->quantity;
        }

        return $total;
    }

    public function getTotalWeightService() {
        $total = 0;

        foreach ($this->purchaseRequestDetailServices as $detail) {
            if ($detail->is_inactive == 0)
                $total+= $detail->weight;
        }

        return $total;
    }

    public function searchByPurchaseOrder() {
        //search purchase request which quantity is not fully purchased yet
        $criteria = new CDbCriteria;

        if ($this->is_service) {
            $criteria->condition = "EXISTS (
                SELECT p.quantity - COALESCE(SUM(r.quantity), 0) AS quantity_remaining
                FROM " . PurchaseRequestDetailService::model()->tableName() . " p
                LEFT OUTER JOIN " . PurchaseDetailRequest::model()->tableName() . " r ON r.purchase_request_detail_service_id = p.id AND r.is_inactive = 0 AND p.is_inactive = 0 
                WHERE t.id = p.purchase_request_header_id
                GROUP BY p.id
                HAVING quantity_remaining > 0
            )";
        } else {
            $criteria->condition = "EXISTS (
                SELECT p.quantity - COALESCE(SUM(r.quantity), 0) AS quantity_remaining
                FROM " . PurchaseRequestDetailComponent::model()->tableName() . " p
                LEFT OUTER JOIN " . PurchaseDetailRequest::model()->tableName() . " r ON r.purchase_request_detail_component_id = p.id AND r.is_inactive = 0 AND p.is_inactive = 0
                WHERE t.id = p.purchase_request_header_id
                GROUP BY p.id
                HAVING quantity_remaining > 0
            )";
        }

        $criteria->compare('t.cn_ordinal', $this->cn_ordinal, true);
        $criteria->compare('t.cn_month', $this->cn_month, true);
        $criteria->compare('t.cn_year', $this->cn_year, true);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.work_order_production_header_id', $this->work_order_production_header_id);
        $criteria->compare('t.job_id', $this->job_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}