<?php

class WorkOrderProductionHeader extends WorkOrderProductionHeaderBase {
    const CN_CONSTANT = 'SPK.P';

    //custom attribute
    public $saleOrderId;
    public $saleOrderCnOrdinal;
    public $saleOrderCnMonth;
    public $saleOrderCnYear;
    
    public $ordinal;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function searchByRequirement() {
        $criteria = new CDbCriteria;

        $criteria->condition = "t.id NOT IN (SELECT work_order_production_header_id FROM tblet_requirement_header WHERE is_inactive = 0)";

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