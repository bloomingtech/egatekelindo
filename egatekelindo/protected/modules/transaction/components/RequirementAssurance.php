<?php

class RequirementAssurance extends CComponent {

    public $header; // Table header
    public $details; //Table detail
    public $brandDiscounts; // table brand discount    
	public $detailComponents;

    public function __construct($header, array $details, array $brandDiscounts, array $detailComponents) {
        $this->header = $header;
        $this->details = $details;
        $this->brandDiscounts = $brandDiscounts;
		$this->detailComponents = $detailComponents;
    }

    public function generateCodeNumber() {
        $criteria = new CDbCriteria();
        $criteria->order = 't.id DESC';
        $requirementAssuranceLast = RequirementAssuranceHeader::model()->find($criteria);

        if ($requirementAssuranceLast !== null)
            $this->header->setCodeNumber(
				$requirementAssuranceLast->cn_ordinal, $requirementAssuranceLast->cn_month, $requirementAssuranceLast->cn_year);
		
        $this->header->setCodeNumberByNext(date('m'), date('y'));
    }
	
    public function addRequirementAssuranceBrandDiscounts() {
        $componentBrandDiscounts = ComponentBrandDiscount::model()->findAll();

        if ($componentBrandDiscounts) {
            foreach ($componentBrandDiscounts as $componentBrandDiscount) {
                $requirementAssuranceBrandDiscount = new RequirementAssuranceBrandDiscount();
                $requirementAssuranceBrandDiscount->value_1 = $componentBrandDiscount->value_1;
                $requirementAssuranceBrandDiscount->value_2 = $componentBrandDiscount->value_2;
                $requirementAssuranceBrandDiscount->value_3 = $componentBrandDiscount->value_3;
                $requirementAssuranceBrandDiscount->value_4 = $componentBrandDiscount->value_4;
                $requirementAssuranceBrandDiscount->value_calculation_type_1 = $componentBrandDiscount->value_calculation_type_1;
                $requirementAssuranceBrandDiscount->value_calculation_type_2 = $componentBrandDiscount->value_calculation_type_2;
                $requirementAssuranceBrandDiscount->value_calculation_type_3 = $componentBrandDiscount->value_calculation_type_3;
                $requirementAssuranceBrandDiscount->value_calculation_type_4 = $componentBrandDiscount->value_calculation_type_4;
                $requirementAssuranceBrandDiscount->component_brand_discount_id = $componentBrandDiscount->id;

                $this->brandDiscounts[] = $requirementAssuranceBrandDiscount;
            }
        }
    }
	
    public function addDetailPanels($id) {
        $this->details = array();
        $requirementHeader = RequirementHeader::model()->findByPk($id);

        if ($requirementHeader) {
            foreach ($requirementHeader->requirementDetails as $requirementDetail) {
                $detail = new RequirementAssuranceDetailPanel();
                $detail->requirement_detail_id = $requirementDetail->id;
                $detail->quantity = $requirementDetail->quantity;
                $detail->unit_price = $requirementDetail->unit_price;
                $this->details[] = $detail;
            }
        }
    }
	
    public function validate() {
        $valid = $this->header->validate();

        if (!$valid)
            $this->header->addError('error', 'Header Error');

        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
                $fields = array('quantity, wiring_value, wiring_name, requirement_detail_id');
                $valid = $valid && $detail->validate($fields);
            }
        }
        else
            $valid = false;

        if (count($this->brandDiscounts) > 0) {
            foreach ($this->brandDiscounts as $brandDiscount) {
                $fields = array('component_brand_discount_id');
                $valid = $valid && $brandDiscount->validate($fields);
            }
        }
        else
            $valid = false;

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

    public function flush() {

        $valid = true;

        $valid = $this->header->save(false) && $valid;

        foreach ($this->details as $detail) {
            if ($detail->isNewRecord)
                $detail->requirement_assurance_header_id = $this->header->id;

            $valid = $detail->save(false) && $valid;
        }

        foreach ($this->brandDiscounts as $brandDiscount) {
            if ($brandDiscount->isNewRecord)
                $brandDiscount->requirement_assurance_header_id = $this->header->id;

            $valid = $brandDiscount->save(false) && $valid;
        }

        return $valid;
    }

//    public function validateDetailComponents() {
//        if (count($this->detailComponents) > 0) {
//            foreach ($this->detailComponents as $detailComponent) {
//                $fields = array('quantity, unit_price, requirement_detail_component_id');
//                $valid = $valid && $detailComponent->validate($fields);
//            }
//        }
//        else
//            $valid = false;
//
//        return $valid;
//    }
//
//    public function saveDetailComponents($dbConnection) {
//        $dbTransaction = $dbConnection->beginTransaction();
//        try {
//            $valid = $this->validateDetailComponents() && $this->flushDetailComponents();
//            if ($valid)
//                $dbTransaction->commit();
//            else
//                $dbTransaction->rollback();
//        } catch (Exception $e) {
//            $dbTransaction->rollback();
//            $this->details->addError('error', $e->getMessage());
//            $valid = false;
//        }
//        return $valid;
//    }
//
//    public function flushDetailComponents() {
//        $valid = true;
//
//        foreach ($this->detailComponents as $detailComponent) {
//            if ($detailComponent->isNewRecord)
//                $detailComponent->requirement_assurance_header_id = $this->header->id;
//
//            $valid = $detail->save(false) && $valid;
//        }
//
//        foreach ($this->brandDiscounts as $brandDiscount) {
//            if ($brandDiscount->isNewRecord)
//                $brandDiscount->requirement_assurance_header_id = $this->header->id;
//
//            $valid = $brandDiscount->save(false) && $valid;
//        }
//
//        return $valid;
//    }
}