<?php

class BudgetingDetailComponent extends CComponent {

    public $header;
    public $detailComponents;
    public $detailAccesories;

    public function __construct($header, array $detailComponents, array $detailAccesories) {
        $this->header = $header;
        $this->detailComponents = $detailComponents;
        $this->detailAccesories = $detailAccesories;
    }

    public function addDetailComponent($componentId, $saleOrderDetailId, $headerId) {

        $component = Component::model()->findByPk($componentId);


        if ($component != NULL) {
            $budgetingBrandDiscount = BudgetingBrandDiscount::model()->findByAttributes(array('budgeting_header_id' => $headerId, 'component_brand_discount_id' => $component->component_brand_discount_id));

            $detail = new BudgetingDetail();
            $detail->component_name = $component->name;
            $detail->unit_price = $component->selling_price;
            $detail->brand_name = $component->componentBrand->name;
            $detail->type = $component->type;
            $detail->budgeting_header_id = $headerId;
            $detail->sale_order_detail_id = $saleOrderDetailId;
            if ($budgetingBrandDiscount)
                $detail->budgeting_brand_discount_id = $budgetingBrandDiscount->id;
            $this->detailComponents[] = $detail;
        }
    }

    public function addDetailComponentAccesories($componentId, $saleOrderDetailId, $headerId) {

        $component = Component::model()->findByPk($componentId);

        if ($component != NULL) {
            $budgetingBrandDiscount = BudgetingBrandDiscount::model()->findByAttributes(array('budgeting_header_id' => $headerId, 'component_brand_discount_id' => $component->component_brand_discount_id));

            $detail = new BudgetingDetailAccesories();
            $detail->component_name = $component->name;
            $detail->unit_price = $component->selling_price;
            $detail->brand_name = $component->componentBrand->name;
            $detail->type = $component->type;
            $detail->budgeting_header_id = $headerId;
            $detail->sale_order_detail_id = $saleOrderDetailId;
            if ($budgetingBrandDiscount)
                $detail->budgeting_brand_discount_id = $budgetingBrandDiscount->id;
            $this->detailAccesories[] = $detail;
        }
    }

    public function removeDetailAt($index) {
        array_splice($this->detailComponents, $index, 1);
    }

    public function flush() {
        $valid = TRUE;
        foreach ($this->detailComponents as $detail) {
			$estimationPanel = EstimationPanel::model()->findByAttributes(array('sale_order_detail_id' => $detail->sale_order_detail_id));
			$estimationComponents = EstimationComponent::model()->findAllByAttributes(array('estimation_panel_id' => $estimationPanel->id));
			
			foreach ($estimationComponents as $estimationComponent) {
				if ($estimationComponent->component_id == $detail->component_id)
					$detail->estimation_component_id = $estimationComponent->id;
//				else
//					$detail->estimation_component_id = null;
			}

            if ($detail->isNewRecord) {
                $detail->budgeting_header_id = $this->header->id;
            }
            $valid = $valid && $detail->save(false);
        }
        foreach ($this->detailAccesories as $detail) {
			$estimationPanel = EstimationPanel::model()->findByAttributes(array('sale_order_detail_id' => $detail->sale_order_detail_id));
			$estimationComponentAccesories = EstimationComponentAccesories::model()->findAllByAttributes(array('estimation_panel_id' => $estimationPanel->id));
			
			foreach ($estimationComponentAccesories as $estimationComponentAccesory) {
				if ($estimationComponentAccesory->component_cu_id == $detail->component_cu_id)
					$detail->estimation_component_accesories_id = $estimationComponentAccesory->id;
//				else
//					$detail->estimation_component_accesories_id = null;
			}

            if ($detail->isNewRecord) {
                $detail->budgeting_header_id = $this->header->id;
            }
            $valid = $valid && $detail->save(false);
        }
        return $valid;
    }

    public function save($dbConnection) {
        $dbTransaction = $dbConnection->beginTransaction();
        try {
            $valid = $this->validate() && $this->flush();
            if ($valid)
                $dbTransaction->commit();
            else
                $dbTransaction->rollback();
        } catch (Exception $e) {
            $dbTransaction->rollback();
            $this->header->addError('error', $e->getMessage());
            $valid = false;
        }
        return $valid;
    }

    public function count() {
        $valid = true;

        if (count($this->detailComponents) === 0)
            $valid = false;

        return $valid;
    }

    public function validate() {

        $valid = TRUE;
        if (count($this->detailComponents) > 0) {
            foreach ($this->detailComponents as $detail) {
                $fields = array('quantity');
                $valid = $valid && $detail->validate($fields);
            }
        }

        if (count($this->detailAccesories) > 0) {
            foreach ($this->detailAccesories as $detail) {
                $fields = array('quantity');
                $valid = $valid && $detail->validate($fields);
            }
        }


        return $valid;
    }

    public function getSubTotal($saleOrderDetailId) {
        $total = 0.00;

        foreach ($this->detailComponents as $detail)
            if ($detail->sale_order_detail_id == $saleOrderDetailId && $detail->is_inactive == 0)
                $total += $detail->total;

        return $total;
    }

    public function getTotalAccesories($saleOrderDetailId) {
        $total = 0.00;

        foreach ($this->detailAccesories as $detail)
            if ($detail->sale_order_detail_id == $saleOrderDetailId && $detail->is_inactive == 0)
                $total += $detail->total;

        return $total;
    }

}
