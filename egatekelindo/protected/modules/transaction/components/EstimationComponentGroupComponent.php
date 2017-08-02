<?php

class EstimationComponentGroupComponent extends CComponent {

    public $header;
    public $detailComponents;

    public function __construct($header, array $detailComponents) {
        $this->header = $header;
        $this->detailComponents = $detailComponents;
    }

    public function addDetailComponent($componentId) {

        $component = Component::model()->findByPk($componentId);

        if ($component != NULL) {

            $detail = new EstimationComponent();
            $detail->component_id = $component->id;

            $price = 0;

            if ($component->component_brand_discount_id != NULL) {
                foreach ($this->header->estimationPanel->estimationHeader->estimationBrandDiscounts as $estimationBrandDiscount) {
                    if ($estimationBrandDiscount->component_brand_discount_id == $component->component_brand_discount_id) {
                        $price_1 = $estimationBrandDiscount->value_1 > 0 ? $estimationBrandDiscount->value_1 : 1;
                        $price_2 = $estimationBrandDiscount->value_2 > 0 ? $estimationBrandDiscount->value_2 : 1;
                        $price_3 = $estimationBrandDiscount->value_3 > 0 ? $estimationBrandDiscount->value_3 : 1;
                        $price_4 = $estimationBrandDiscount->value_4 > 0 ? $estimationBrandDiscount->value_4 : 1;
                        $price_5 = $estimationBrandDiscount->value_5 > 0 ? $estimationBrandDiscount->value_5 : 1;
                        $rate = $estimationBrandDiscount->currentRate > 0 ? $estimationBrandDiscount->currentRate : 1;

                        $price = $price_1 * $price_2 * $price_3 * $price_4 * $price_5 * $component->selling_price;
                    }
                }
            }

            else
                $price = $component->selling_price;

            $detail->basic_price = $price;
            $detail->unit_price = $component->selling_price;
            $detail->brand_id = $component->component_brand_id;
            $detail->name = $component->name;
            $detail->type = $component->type;
            $this->detailComponents[] = $detail;
        }
    }

    public function removeComponentDetail($index) {
        array_splice($this->detailComponents, $index, 1);
    }

    public function flush() {


        $valid = $this->header->save(false);

        foreach ($this->detailComponents as $i => $detailComponent) {

            if ($detailComponent->isNewRecord) {
                $detailComponent->estimation_panel_id = $this->header->estimation_panel_id;
                $detailComponent->estimation_component_group_id = $this->header->id;
            }

            if ($detailComponent->component->component_brand_discount_id != NULL) {
                foreach ($this->header->estimationPanel->estimationHeader->estimationBrandDiscounts as $brandDiscount)
                    if ($brandDiscount->component_brand_discount_id == $detailComponent->component->component_brand_discount_id)
                        $detailComponent->estimation_brand_discount_id = $brandDiscount->id;
            }
            if ($detailComponent->accesories_phase_id != NULL)
                $detailComponent->accesories_phase_value = $detailComponent->accesoriesPhase->value;



            if ($detailComponent->isNewRecord) {
                $detailComponentHistory = new EstimationComponentHistory();
                $detailComponentHistory->attributes = $detailComponent->attributes;
                $valid = $detailComponentHistory->save(false) && $valid;
            } else {
                $detailComponentCurrent = EstimationComponent::model()->findByPk($detailComponent->id);
                if ($detailComponentCurrent->attributes != $detailComponent->attributes) {
                    $detailComponentHistory = new EstimationComponentHistory();
                    $detailComponentHistory->attributes = $detailComponent->attributes;
                    $valid = $detailComponentHistory->save(false) && $valid;
                }
            }

            $valid = $detailComponent->save(false) && $valid;
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
        $valid = $this->header->validate();

        if (count($this->detailComponents) > 0) {
            foreach ($this->detailComponents as $detail) {
                $fields = array('component_id');
                $valid = $valid && $detail->validate($fields);
            }
        }
        else
            $valid = false;

        return $valid;
    }

    public function getSubTotal() {
        $subTotal = 0.00;
        foreach ($this->detailComponents as $detailComponent) {
            $subTotal+=$detailComponent->getTotal($this->header->estimationPanel->estimationHeader->estimationBrandDiscounts);
        }
        return $subTotal;
    }

}
