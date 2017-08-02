<?php

class Panel extends CComponent {

    public $header;
    public $detailComponents;
    public $detailAccesories;
    public $componentGroups;

    public function __construct($header, array $detailComponents, array $detailAccesories, array $componentGroups) {
        $this->header = $header;
        $this->detailComponents = $detailComponents;
        $this->detailAccesories = $detailAccesories;
        $this->componentGroups = $componentGroups;
    }

    public function addComponentGroup() {
        $this->componentGroups[] = new EstimationComponentGroup();
    }

    public function addDetailComponent($componentId) {

        $component = Component::model()->findByPk($componentId);

        if ($component != NULL) {

            $detail = new EstimationComponent();
            $detail->component_id = $component->id;

            $price = 0;

            if ($component->component_brand_discount_id != NULL) {
                foreach ($this->header->estimationHeader->estimationBrandDiscounts as $estimationBrandDiscount) {
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

    public function addDetailAccesories($componentId) {

        $component = Component::model()->findByPk($componentId);

        if ($component != NULL) {
            $exist = false;
            // Check Duplicate
            foreach ($this->detailAccesories as $detail) {
                if ($detail->component_id == $componentId) {
                    $exist = TRUE;
                    break;
                }
            }
            // add row if not exist
            if (!$exist) {
                $detail = new EstimationComponentAccesories();
                $detail->component_id = $component->id;

                $price = 0;

                if ($component->component_brand_discount_id != NULL) {
                    foreach ($this->header->estimationHeader->estimationBrandDiscounts as $estimationBrandDiscount) {
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
                $this->detailAccesories[] = $detail;
            }
        }
    }

    public function addDetailAccesoriesCu($componentId) {

        $componentCu = ComponentCu::model()->findByPk($componentId);

        if ($componentCu != NULL) {
            $exist = false;
            // Check Duplicate
            foreach ($this->detailAccesories as $detail) {
                if ($detail->component_cu_id == $componentId) {
                    $exist = TRUE;
                    break;
                }
            }
            // add row if not exist
            if (!$exist) {
                $detail = new EstimationComponentAccesories();
                $detail->component_cu_id = $componentCu->id;

                $price = 0;

                if ($componentCu->component_brand_discount_id != NULL) {
                    foreach ($this->header->estimationHeader->estimationBrandDiscounts as $estimationBrandDiscount) {
                        if ($estimationBrandDiscount->component_brand_discount_id == $componentCu->component_brand_discount_id) {
                            $price_1 = $estimationBrandDiscount->value_1 > 0 ? $estimationBrandDiscount->value_1 : 1;
                            $price_2 = $estimationBrandDiscount->value_2 > 0 ? $estimationBrandDiscount->value_2 : 1;
                            $price_3 = $estimationBrandDiscount->value_3 > 0 ? $estimationBrandDiscount->value_3 : 1;
                            $price_4 = $estimationBrandDiscount->value_4 > 0 ? $estimationBrandDiscount->value_4 : 1;
                            $price_5 = $estimationBrandDiscount->value_5 > 0 ? $estimationBrandDiscount->value_5 : 1;
                            $rate = $estimationBrandDiscount->currentRate > 0 ? $estimationBrandDiscount->currentRate : 1;

                            $price = $price_1 / $price_2;
                        }
                    }
                }

                $detail->name = $componentCu->name;
                $detail->basic_price = $price;
                $detail->weight = $componentCu->weight;
                $this->detailAccesories[] = $detail;
            }
        }
    }

    public function removeDetailAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function removeComponentDetail($index) {
        array_splice($this->detailComponents, $index, 1);
    }

    public function removeAccesoriesDetail($index) {
        array_splice($this->detailAccesories, $index, 1);
    }

    public function removePanelAt($index) {
        array_splice($this->panels, $index, 1);
    }

    public function flush() {

        $valid = true;
        if ($this->header->isNewRecord) {
            $estimationPanelHistory = new EstimationPanelHistory();
            $estimationPanelHistory->attributes = $this->header->attributes;
            $valid = $estimationPanelHistory->save(false) && $valid;
        } else {
            $estimationPanelCurrent = EstimationPanel::model()->findByPk($this->header->id);
            if ($estimationPanelCurrent->attributes != $this->header->attributes) {
                $estimationPanelHistory = new EstimationPanelHistory();
                $estimationPanelHistory->attributes = $this->header->attributes;
                $valid = $estimationPanelHistory->save(false) && $valid;
            }
        }

        $valid = $this->header->save(false) && $valid;

        foreach ($this->componentGroups as $i => $componentGroup) {
            if ($componentGroup->isNewRecord) {
                $componentGroup->estimation_panel_id = $this->header->id;
            }


            if ($componentGroup->isNewRecord) {
                $componentGroupHistory = new EstimationComponentGroupHistory();
                $componentGroupHistory->attributes = $componentGroup->attributes;
                $valid = $componentGroupHistory->save(false) && $valid;
            } else {
                $componentGroupCurrent = EstimationComponentGroup::model()->findByPk($componentGroup->id);
                if ($componentGroupCurrent->attributes != $componentGroup->attributes) {
                    $componentGroupHistory = new EstimationComponentGroupHistory();
                    $componentGroupHistory->attributes = $componentGroup->attributes;
                    $valid = $componentGroupHistory->save(false) && $valid;
                }
            }

            $valid = $componentGroup->save(false) && $valid;
        }

//        
//        
////        $lastComponent = EstimationComponent::model()->findByAttributes(array('estimation_panel_id' => $this->header->id), array('order' => 'sort_number DESC'));
//        foreach ($this->detailComponents as $i => $detailComponent) {
//
//            if ($detailComponent->isNewRecord) {
//                $detailComponent->estimation_panel_id = $this->header->id;
////                if ($lastComponent)
////                    $detailComponent->sort_number = $lastComponent->sort_number + 1 + $i;
////                else
//            }
//
////            $detailComponent->sort_number = 1 + $i;
//            if ($detailComponent->component->component_brand_discount_id != NULL) {
//                foreach ($this->header->estimationHeader->estimationBrandDiscounts as $brandDiscount)
//                    if ($brandDiscount->component_brand_discount_id == $detailComponent->component->component_brand_discount_id)
//                        $detailComponent->estimation_brand_discount_id = $brandDiscount->id;
//            }
//            if ($detailComponent->accesories_phase_id != NULL)
//                $detailComponent->accesories_phase_value = $detailComponent->accesoriesPhase->value;
//
//            $valid = $detailComponent->save(false) && $valid;
//        }
//        $lastAccesories = EstimationComponentAccesories::model()->findByAttributes(array('estimation_panel_id' => $this->header->id), array('order' => 'sort_number DESC'));
        foreach ($this->detailAccesories as $i => $detailAccesory) {

            if ($detailAccesory->isNewRecord) {
                $detailAccesory->estimation_panel_id = $this->header->id;
//                if ($lastAccesories)
//                    $detailAccesory->sort_number = $lastComponent->sort_number + 1 + $i;
//                else
            }

//            $detailAccesory->sort_number = 1 + $i;
            if ($detailAccesory->component_id != NULL) {
                if ($detailAccesory->component->component_brand_discount_id != NULL) {
                    foreach ($this->header->estimationHeader->estimationBrandDiscounts as $brandDiscount)
                        if ($brandDiscount->component_brand_discount_id == $detailAccesory->component->component_brand_discount_id)
                            $detailAccesory->estimation_brand_discount_id = $brandDiscount->id;
                }
            }else {
                if ($detailAccesory->componentCu->component_brand_discount_id != NULL) {
                    foreach ($this->header->estimationHeader->estimationBrandDiscounts as $brandDiscount)
                        if ($brandDiscount->component_brand_discount_id == $detailAccesory->componentCu->component_brand_discount_id)
                            $detailAccesory->estimation_brand_discount_id = $brandDiscount->id;
                }
            }

            if ($detailAccesory->accesories_phase_id != NULL)
                $detailAccesory->accesories_phase_value = $detailAccesory->accesoriesPhase->value;


            if ($detailAccesory->isNewRecord) {
                $detailAccesoryHistory = new EstimationComponentAccesoriesHistory();
                $detailAccesoryHistory->attributes = $detailAccesory->attributes;
                $valid = $detailAccesoryHistory->save(false) && $valid;
            } else {
                $detailAccesoryCurrent = EstimationComponentAccesories::model()->findByPk($detailAccesory->id);
                if ($detailAccesoryCurrent->attributes != $detailAccesory->attributes) {
                    $detailAccesoryHistory = new EstimationComponentAccesoriesHistory();
                    $detailAccesoryHistory->attributes = $detailAccesory->attributes;
                    $valid = $detailAccesoryHistory->save(false) && $valid;
                }
            }

            $valid = $detailAccesory->save(false) && $valid;
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

        if (count($this->detailAccesories) === 0 || count($this->componentGroups) === 0)
            $valid = false;

        return $valid;
    }

    public function validate() {
        if ($this->header->isNewRecord) {
            $lastPanel = EstimationPanel::model()->findByAttributes(array('estimation_header_id' => $this->header->estimation_header_id), array('order' => 'sort_number DESC'));
            if ($lastPanel)
                $this->header->sort_number = $lastPanel->sort_number + 1;
            else
                $this->header->sort_number = 1;
        }

        $valid = $this->header->validate();

        if (!$valid)
            $this->header->addError('error', 'Header Error');
        else {
            $valid = $valid && $this->count();
            if (!$valid)
                $this->header->addError('error', 'Salah satu form tidak terisi baik diskon atau panel');
        }

//        if (count($this->detailComponents) > 0) {
//            foreach ($this->detailComponents as $detail) {
//                $fields = array('component_id');
//                $valid = $valid && $detail->validate($fields);
//            }
//        }
//        else
//            $valid = false;
//        if (count($this->detailAccesories) > 0) {
//            foreach ($this->detailAccesories as $detail) {
//
//                $valid = $valid && $detail->validate();
//            }
//        }
//        else
//            $valid = false;

        return $valid;
    }

    public function countHeader() {
        $valid = true;

        if (count($this->details) === 0)
            $valid = false;

        return $valid;
    }

    public function getSubTotal() {
        $subTotal = 0.00;
        foreach ($this->detailComponents as $detailComponent) {
            $subTotal+=$detailComponent->getTotal($this->header->estimationHeader->estimationBrandDiscounts);
        }
        return $subTotal;
    }

    public function getSubTotalAccesories() {
        $subTotal = 0.00;
        foreach ($this->detailAccesories as $detailAccesories) {
            $subTotal+=$detailAccesories->getTotal($this->header->estimationHeader->estimationBrandDiscounts);
        }
        return $subTotal;
    }

}
