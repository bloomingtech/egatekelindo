<?php

class ComponentCategory extends ComponentCategoryBase
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
    public function getAllTotalWithoutPpn($saleOrderHeaderId) {
        $value = 0;
        $estimationHeader = EstimationHeader::model()->findByAttributes(array('sale_order_header_id' => $saleOrderHeaderId));

        foreach ($estimationHeader->estimationPanels as $estimationPanel) {
            foreach ($estimationPanel->estimationComponents as $detail) {
                if ($detail->component->component_category_id == $this->id)
                    $value += $detail->totalOnly;
			}
        }
        return $value;
    }

    public function getAllTotalWithPpn($budgetHeaderId) {
        $value = 0;
        $budgetHeader = BudgetingHeader::model()->findByPk($budgetHeaderId);

        foreach ($budgetHeader->budgetingDetails as $budgetingDetail) {
            if ($budgetingDetail->component->component_category_id == $this->id)
                $value += $budgetingDetail->total;
        }
        return $value;
    }

    public function getAllTotalDifference($saleOrderHeaderId, $budgetHeaderId) {
        return $this->getAllTotalWithoutPpn($saleOrderHeaderId) - $this->getAllTotalWithPpn($budgetHeaderId);
    }

}