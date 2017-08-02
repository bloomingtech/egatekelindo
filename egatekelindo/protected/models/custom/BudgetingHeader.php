<?php

class BudgetingHeader extends BudgetingHeaderBase {
    const CN_CONSTANT = "BGT";

    public $ordinal;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getSubTotal($saleOrderDetailId) {
        $total = 0.00;

        foreach ($this->budgetingDetails as $detail)
            if ($detail->sale_order_detail_id == $saleOrderDetailId && $detail->is_inactive == 0)
                $total += $detail->total;

        return $total;
    }

    public function getTotalAccesories($saleOrderDetailId) {
        $total = 0.00;

        foreach ($this->budgetingDetailAccesories as $detail) {
            if ($detail->sale_order_detail_id == $saleOrderDetailId && $detail->is_inactive == 0)
                $total += $detail->total;
		}

        return $total;
    }

    public function getTotalCu($saleOrderDetailId) {
        $total = 0.00;

        foreach ($this->budgetingDetailAccesories as $detail){
            if ($detail->sale_order_detail_id == $saleOrderDetailId && $detail->component_cu_id != NULL)
                $total += $detail->total;
		}

        return $total;
    }

    public function getTotalWiring($saleOrderDetailId) {

        return $this->getSubTotal($saleOrderDetailId) + $this->getTotalCu($saleOrderDetailId);
    }

    public function getTotalAllCuWithoutPPn() {
        $totalCu = 0;

        $estimationHeader = EstimationHeader::model()->findByAttributes(array('sale_order_header_id' => $this->sale_order_header_id));
        if ($estimationHeader){
            foreach ($estimationHeader->estimationPanels as $estimationPanel) 
                $totalCu += $estimationHeader->getTotalAccesories($estimationPanel->id);
		}

        return $totalCu;
    }

    public function getTotalAllCuWithPPn() {
        $totalCu = 0;
        foreach ($this->budgetingDetailAccesories as $detail)
            $totalCu += $detail->total;
		
        return $totalCu;
    }

	
    public function getTotalAllCuDifference() {
		
        return $this->totalAllCuWithoutPPn - $this->totalAllCuWithPPn;
    }

    public function getTotalComponentGroupWithoutPPn($componentGroupId) {
        $total = 0;

        $estimationHeader = EstimationHeader::model()->findByAttributes(array('sale_order_header_id' => $this->sale_order_header_id));
        if ($estimationHeader){
            foreach ($estimationHeader->estimationPanels as $estimationPanel) 
                $total += $estimationHeader->getSubTotalComponentEachGroup($estimationPanel->id, $componentGroupId);
		}

        return $total;
    }

    public function getTotalComponentGroupWithPPn($componentGroupId) {
        $total = 0;

        foreach ($this->budgetingDetails as $budgetingDetail)
            if ($budgetingDetail->component->component_group_id == $componentGroupId)
                $total+=$budgetingDetail->total;

        return $total;
    }

    public function getTotalComponentDifference($componentGroupId) {
        return $this->getTotalComponentGroupWithoutPPn($componentGroupId) - $this->getTotalComponentGroupWithPPn($componentGroupId) ;
    }

    public function getProfitBeforeWiringValue() {
        $grandTotalBeforeWiring = 0;
        foreach ($this->budgetingDetails as $budgetingDetail)
            $grandTotalBeforeWiring+=$budgetingDetail->total;

        $grandTotalBeforeWiring+= $this->getTotalAllCuWithoutPPn() + $this->accessories_value;
        
        
        return $this->saleOrderHeader->value - $grandTotalBeforeWiring;
    }
    
    public function getProfitBeforeWiringPercentage() {
        return $this->getProfitBeforeWiringValue() / $this->saleOrderHeader->value * 100;
    }
    
    public function getShippingFeePercentage() {
        return $this->shipping_fee / $this->saleOrderHeader->value * 100;
    }

    public function getOverheadValue() {
        return $this->saleOrderHeader->value * $this->overhead_percentage / 100;
    }

    public function getFeeValue() {
        return $this->saleOrderHeader->value * $this->fee_percentage / 100;
    }
    
    public function getProfitAfterOverheadValue() {
        return $this->getProfitBeforeWiringValue() - $this->getOverheadValue() - $this->getFeeValue() - $this->shipping_fee;
    }
    
    public function getProfitAfterOverheadPercentage() {
        return $this->getProfitAfterOverheadValue() / $this->saleOrderHeader->value * 100;
    }

    public function searchByWorkOrderDrawing() {
        $criteria = new CDbCriteria;

        $criteria->condition = "t.id IN (SELECT bh.id FROM tblet_sale_order_detail sod
            JOIN tblet_budgeting_header bh ON bh.sale_order_header_id = sod.sale_order_header_id
            WHERE  sod.id NOT IN (SELECT sale_order_detail_id FROM tblet_work_order_drawing_detail))";

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

        $criteria->condition = "t.id NOT IN (SELECT budgeting_header_id FROM tblet_requirement_header WHERE is_inactive = 0)";

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