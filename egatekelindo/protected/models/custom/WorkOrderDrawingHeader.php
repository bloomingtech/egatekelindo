<?php

class WorkOrderDrawingHeader extends WorkOrderDrawingHeaderBase {
    const CN_CONSTANT = 'SPK.G';
    
    public $ordinal;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function searchByWorkOrderProduction() {
        $criteria = new CDbCriteria;

        $criteria->condition = "EXISTS (
			SELECT COUNT(d.id) - COALESCE(COUNT(p.id), 0) AS quantity_remaining
			FROM " . WorkOrderDrawingDetail::model()->tableName() . " d
			LEFT OUTER JOIN " . WorkOrderProductionDetail::model()->tableName() . " p
			ON d.id = p.work_order_drawing_detail_id
			WHERE t.id = d.work_order_drawing_header_id AND d.is_inactive = 0
			GROUP BY d.id
			HAVING quantity_remaining > 0
		)";

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