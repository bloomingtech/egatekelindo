<?php

class RequirementDetailPanelComponent extends CComponent {

    public $header;
    public $detailComponents;
    public $detailAdditionals;

    public function __construct($header, array $detailComponents, array $detailAdditionals) {
        $this->header = $header;
        $this->detailComponents = $detailComponents;
        $this->detailAdditionals = $detailAdditionals;
    }

    public function addDetailComponent($componentId, $requierementDetailId) {

        $component = Component::model()->findByPk($componentId);

        if ($component != NULL) {

            $detail = new RequirementDetailComponent();
            $detail->component_id = $component->id;
            $detail->component_name = $component->name;
			$detail->unit_price = $component->budget_price;
            $detail->requirement_detail_id = $requierementDetailId;
            $this->detailComponents[] = $detail;
        }
    }
    
    public function addDetailComponentCu($componentCuId, $requierementDetailId) {

        $componentCu = ComponentCu::model()->findByPk($componentCuId);

        if ($componentCu != NULL) {

            $detail = new RequirementDetailComponent();
            $detail->component_cu_id = $componentCu->id;
            $detail->component_name = $componentCu->name;            
            $detail->requirement_detail_id = $requierementDetailId;
            $this->detailComponents[] = $detail;
        }
    }
    
//    public function addDetailComponentAdditional($componentId, $requierementDetailId) {
//
//        $component = Component::model()->findByPk($componentId);
//
//        if ($component != NULL) {
//
//            $detail = new RequirementDetailAdditional();
//            $detail->component_id = $component->id;
//            $detail->requirement_detail_id = $requierementDetailId;
//            $this->detailAdditionals[] = $detail;
//        }
//    }
//    
//    public function addDetailComponentAdditionalCu($componentCuId, $requierementDetailId) {
//
//        $componentCu = ComponentCu::model()->findByPk($componentCuId);
//
//        if ($componentCu != NULL) {
//
//            $detail = new RequirementDetailAdditional();
//            $detail->component_cu_id = $componentCu->id;
//            $detail->requirement_detail_id = $requierementDetailId;
//            $this->detailAdditionals[] = $detail;
//        }
//    }

    public function removeDetailAt($index) {
        array_splice($this->detailComponents, $index, 1);
    }
    
//    public function removeDetailAdditionalAt($index) {
//        array_splice($this->detailAdditionals, $index, 1);
//    }

    public function flush() {
        $valid = TRUE;
        foreach ($this->detailComponents as $detail) {

			if ($detail->is_inactive == 0) {
				if ($detail->isNewRecord) {
					$detail->requirement_detail_id = $this->header->id;
				}
				$valid = $valid && $detail->save(false);
			}
			else
				$valid = $valid && $detail->delete();
        }
     
//        foreach ($this->detailAdditionals as $detail) {
//
//            if ($detail->isNewRecord) {
//                $detail->requirement_detail_id = $this->header->id;
//            }
//            $valid = $valid && $detail->save(false);
//        }
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
        else
            $valid = false;


        return $valid;
    }

}
