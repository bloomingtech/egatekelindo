<?php

class RequirementHeader extends RequirementHeaderBase {
    const CN_CONSTANT = 'RQMT';

    const CN_CONSTANT_COMPONENT = 'CPR';
    const CN_CONSTANT_NON_COMPONENT = 'CR';

    public $ordinal;

    public function getCnConstant() {
        if ($this->is_component === null || $this->is_component === '')
            return '';
        else
            return ($this->is_component) ? self::CN_CONSTANT_COMPONENT : self::CN_CONSTANT_NON_COMPONENT;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getSubTotal() {
        $total = 0.00;

        foreach ($this->requirementDetails as $detail)
            $total += $detail->total;

        return $total;
    }
//
//    public function getSubTotalComponent() {
//        $total = 0.00;
//
//        foreach ($this->requirementDetails as $detail)
//            foreach ($detail->requirementDetailComponents as $component)
//                $total += $component->total;
//
//        return $total;
//    }
//
//    public function getSubTotalAdditional() {
//        $total = 0.00;
//
//        foreach ($this->requirementDetails as $detail)
//            foreach ($detail->requirementDetailAdditionals as $additional)
//                $total += $additional->total;
//
//        return $total;
//    }
//    
//    public function getSubTotalDifference() {
//        return $this->getSubTotalAdditional() - $this->getSubTotalComponent();
//    }

    public function getTotalCuEachPanel($detailPanel, $componentCu) {
        $total = 0;

        foreach ($this->requirementDetails as $i => $detail)
            foreach ($detail->requirementDetailComponents as $detailComponent) {
                if ($detailComponent->is_inactive == 0) {
                    if ($detailComponent->budgeting_detail_accesories_id != NULL) {
                        if ($detailComponent->budgetingDetailAccesories->component_cu_id == $componentCu->budgetingDetailAccesories->component_cu_id && $detailComponent->requirement_detail_id == $detailPanel->id) {
                            $total+= $detailComponent->quantity;
                        }
                    }
                }
            }

        return $total;
    }

    public function getTotalComponentEachPanel($detailPanel, $component) {
        $total = 0;

        foreach ($this->requirementDetails as $i => $detail)
            foreach ($detail->requirementDetailComponents as $detailComponent) {
                if ($detailComponent->is_inactive == 0) {
//                    if ($detailComponent->budgeting_detail_id != NULL) {
//                        if ($detailComponent->component_id == $component->component_id && $detailComponent->requirement_detail_id == $detailPanel->id) {
//                            $total+= $detailComponent->quantity;
//                        }
//                    }
//					else {
						if ($detailComponent->component_id == $component->component_id && $detailComponent->requirement_detail_id == $detailPanel->id)
                            $total+= $detailComponent->quantity;
//					}
                }
            }

        return $total;
    }

    public function getTotalComponentStockEachPanel($detailPanel, $component) {
        $total = 0;

        foreach ($this->requirementDetails as $i => $detail)
            foreach ($detail->requirementDetailComponents as $detailComponent) {
                if ($detailComponent->is_inactive == 0 && $detailComponent->is_stock == 1) {
//                    if ($detailComponent->budgeting_detail_id != NULL) {
//                        if ($detailComponent->component_id == $component->component_id && $detailComponent->requirement_detail_id == $detailPanel->id) {
//                            $total+= $detailComponent->quantity;
//                        }
//                    }
//					else {
						if ($detailComponent->component_id == $component->component_id && $detailComponent->requirement_detail_id == $detailPanel->id)
                            $total+= $detailComponent->quantity;
//					}
                }
            }

        return $total;
    }

    public function getTotalComponentPurchaseEachPanel($detailPanel, $component) {
        $total = 0;

        foreach ($this->requirementDetails as $i => $detail)
            foreach ($detail->requirementDetailComponents as $detailComponent) {
                if ($detailComponent->is_inactive == 0 && $detailComponent->is_stock == 0) {
//                    if ($detailComponent->budgeting_detail_id != NULL) {
//                        if ($detailComponent->component_id == $component->component_id && $detailComponent->requirement_detail_id == $detailPanel->id) {
//                            $total+= $detailComponent->quantity;
//                        }
//                    }
//					else {
						if ($detailComponent->component_id == $component->component_id && $detailComponent->requirement_detail_id == $detailPanel->id)
                            $total+= $detailComponent->quantity;
//					}
                }
            }

        return $total;
    }

    public function searchByRequirementAssurance() {
        $criteria = new CDbCriteria;

        $criteria->condition = "t.id NOT IN (SELECT requirement_header_id FROM tblet_requirement_assurance_header WHERE is_inactive = 0)";

        $criteria->compare('t.cn_ordinal', $this->cn_ordinal);
        $criteria->compare('t.cn_month', $this->cn_month);
        $criteria->compare('t.cn_year', $this->cn_year);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.is_inactive', 0);

        return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
    }
    
    public function searchByPurchaseOrder() {
        //search purchase request which quantity is not fully purchased yet
        $criteria = new CDbCriteria;

        $criteria->condition = "EXISTS (
            SELECT p.quantity - COALESCE(SUM(r.quantity), 0) AS quantity_remaining
            FROM " . RequirementDetailComponent::model()->tableName() . " p
            LEFT OUTER JOIN " . RequirementDetail::model()->tableName() . " d ON d.id = p.requirement_detail_id
            LEFT OUTER JOIN " . PurchaseDetailRequirement::model()->tableName() . " r ON r.requirement_detail_component_id = p.id AND r.is_inactive = 0 AND p.is_inactive = 0 
            WHERE t.id = d.requirement_header_id
            GROUP BY p.id
            HAVING quantity_remaining > 0
        )";

        $criteria->compare('t.cn_ordinal', $this->cn_ordinal, true);
        $criteria->compare('t.cn_month', $this->cn_month, true);
        $criteria->compare('t.cn_year', $this->cn_year, true);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.work_order_production_header_id', $this->work_order_production_header_id);
        $criteria->compare('t.sale_order_header_id', $this->sale_order_header_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}