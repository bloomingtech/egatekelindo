<?php

class Requirement extends CComponent {

    public $header;
    public $details;
    public $detailComponents;

    public function __construct($header, array $details, array $detailComponents) {
        $this->header = $header;
        $this->details = $details;
        $this->detailComponents = $detailComponents;
    }

    public function generateCodeNumber($currentMonth, $currentYear) {
        $requirementHeader = RequirementHeader::model()->find(array(
            'order' => 'id DESC',
		));

        if ($requirementHeader !== null)
            $this->header->setCodeNumber($requirementHeader->cn_ordinal, $requirementHeader->cn_month, $requirementHeader->cn_year);

        $this->header->setCodeNumberByNext($currentMonth, $currentYear);
    }

    public function addDetails($id) {
        $this->details = array();
        $workOrderProductionHeader = WorkOrderProductionHeader::model()->findByPk($id);

        if ($workOrderProductionHeader) {
            foreach ($workOrderProductionHeader->workOrderProductionDetails as $workOrderProductionDetail) {
                $detail = new RequirementDetail();
                $detail->sale_order_detail_id = $workOrderProductionDetail->workOrderDrawingDetail->saleOrderDetail->id;
                $detail->work_order_production_detail_id = $workOrderProductionDetail->id;
                $detail->quantity = $workOrderProductionDetail->workOrderDrawingDetail->saleOrderDetail->quantity;
                $detail->unit_price = $workOrderProductionDetail->workOrderDrawingDetail->saleOrderDetail->unit_price;
                $this->details[] = $detail;
            }
        }
    }

    public function addDetail($index) {
        $detail = new RequirementDetailComponent();
        $detail->requirement_detail_id = $index;
        $this->detailComponents[] = $detail;
    }

    public function removeDetailAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function removeDetailPanelAt($index) {
        array_splice($this->detailComponents, $index, 1);
    }

    public function validate() {
        $validOrdinal = TRUE;
        $headerValidate = RequirementHeader::model()->findByAttributes(array('cn_ordinal' => $this->header->cn_ordinal, 'cn_month' => $this->header->cn_month, 'cn_year' => $this->header->cn_year));
        if ($headerValidate && $headerValidate->id != $this->header->id) {
            $valid = FALSE;
            $validOrdinal = FALSE;
        }
        else
            $valid = TRUE;

        $valid = $this->header->validate() && $valid;

        if (!$valid)
            $this->header->addError('error', 'Header Error');
		
        if (!$validOrdinal)
            $this->header->addError('ordinal', 'Number already exist');

        $valid = $valid && $this->validateDetailsCount();

        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
                $fields = array('quantity', 'unit_price', 'sale_order_detail_id');
                $valid = $valid && $detail->validate($fields);
            }
        }
        else
            $valid = false;

        return $valid;
    }

    public function validateDetailsCount() {
        $valid = true;
        if (count($this->details) === 0) {
            $valid = false;
            $this->header->addError('error', 'Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.');
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
            $valid = false;
        }

        return $valid;
    }

    public function delete($dbConnection) {
        $dbTransaction = $dbConnection->beginTransaction();
        try {
            $valid = true;

            foreach ($this->details as $detail)
                $valid = $valid && $detail->delete();

            $valid = $valid && $this->header->delete();

            if ($valid)
                $dbTransaction->commit();
            else
                $dbTransaction->rollback();
        } catch (Exception $e) {
            $dbTransaction->rollback();
            $valid = false;
        }

        return $valid;
    }

    public function flush() {
        $valid = $this->header->save(false);

        //counter for skipping because zero qutntity user input
        foreach ($this->details as $i => $detail) {
            if ($detail->quantity <= 0) {
                continue;
            }

            if ($detail->isNewRecord) {
                $detail->requirement_header_id = $this->header->id;
                $valid = $valid && $detail->save(false);
            }

            if ($this->header->is_component) {
                $budgetingDetails = BudgetingDetail::model()->findAllByAttributes(array('sale_order_detail_id' => $detail->sale_order_detail_id));

                foreach ($budgetingDetails as $budgetingDetail) {
                    $requirementDetailComponent = new RequirementDetailComponent();
                    $requirementDetailComponent->component_name = $budgetingDetail->component_name;
                    $requirementDetailComponent->quantity = $budgetingDetail->quantity;
                    $requirementDetailComponent->unit_price = $budgetingDetail->unit_price;
                    $requirementDetailComponent->requirement_detail_id = $detail->id;
                    $requirementDetailComponent->budgeting_detail_id = $budgetingDetail->id;
					$requirementDetailComponent->component_id = $budgetingDetail->component_id;

                    $valid = $valid && $requirementDetailComponent->save(false);
                }
            } else {

                $budgetingDetailAccesories = BudgetingDetailAccesories::model()->findAllByAttributes(array('sale_order_detail_id' => $detail->sale_order_detail_id));

                foreach ($budgetingDetailAccesories as $budgetingDetailAccesory) {
                    $requirementDetailComponent = new RequirementDetailComponent();
                    $requirementDetailComponent->component_name = $budgetingDetailAccesory->component_name;
                    $requirementDetailComponent->quantity = $budgetingDetailAccesory->quantity;
                    $requirementDetailComponent->unit_price = $budgetingDetailAccesory->unit_price;
                    $requirementDetailComponent->requirement_detail_id = $detail->id;
                    $requirementDetailComponent->budgeting_detail_accesories_id = $budgetingDetailAccesory->id;
					$requirementDetailComponent->component_cu_id = $budgetingDetailAccesory->component_cu_id;
                    $valid = $valid && $requirementDetailComponent->save(false);
                }
            }



//            foreach ($this->detailComponents as $detailComponent) {
//                if ($detailComponent->requirement_detail_id == $i && ($detailComponent->budgeting_detail_id != NULL || $detailComponent->budgeting_detail_accesories_id != NULL)) {
//                    $detailComponent->requirement_detail_id = $detail->id;
//                    $valid = $valid && $detailComponent->save(false);
//                }
//            }
        }

//        foreach ($this->detailComponents as $detailComponent) {
//            if ($detailComponent->budgeting_detail_accesories_id == NULL && $detailComponent->budgeting_detail_id == NULL) {
//                $detailComponent->requirement_detail_id = $this->details[$detailComponent->requirement_detail_id]->id;
//                $valid = $valid && $detailComponent->save(false);
//            }
//        }

        return $valid;
    }

    public function getSubTotal() {
        $total = 0.00;

        foreach ($this->details as $detail)
            $total += $detail->total;

        return $total;
    }

    public function getSubTotalPanel($index) {
        $total = 0.00;

        foreach ($this->detailComponents as $detailComponent) {
            if ($detailComponent->requirement_detail_id == $index)
                $total += $detailComponent->total;
		}

        return $total;
    }

}
