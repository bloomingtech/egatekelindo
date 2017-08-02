<?php

class Estimation extends CComponent {

    public $header; // Table estimation header
    public $details; //Table estimation brand discount
    public $panels; // Table estimation panel
    public $detailComponents;
    public $detailAccesories;
    public $estimationCurrencies; // Table estimation currency

    public function __construct($header, array $details, array $panels, array $detailComponents, array $detailAccesories, array $estimationCurrencies) {
        $this->header = $header;
        $this->details = $details;
        $this->panels = $panels;
        $this->detailComponents = $detailComponents;
        $this->detailAccesories = $detailAccesories;
        $this->estimationCurrencies = $estimationCurrencies;
    }

    public function generateCodeNumber() {
        $criteria = new CDbCriteria();
        $criteria->order = 't.id DESC';
        $estimationLast = EstimationHeader::model()->find($criteria);


        if ($estimationLast !== null)
            $this->header->setCodeNumber(
                    $estimationLast->cn_ordinal, $estimationLast->cn_month, $estimationLast->cn_year);
        $this->header->setCodeNumberByNext(date('m'), date('y'));
    }

    public function addEstimationCurrencies() {
        $currencies = Currency::model()->findAll();

        if ($currencies) {
            $this->detailComponents[] = array();
            foreach ($currencies as $currency) {
                $estimationCurrency = new EstimationCurrency();
                $estimationCurrency->currency_id = $currency->id;
                $estimationCurrency->value = $currency->rate;
                $this->estimationCurrencies[] = $estimationCurrency;
            }
        }
    }

    public function addDetails() {
        $componentBrandDiscounts = ComponentBrandDiscount::model()->findAll();

        if ($componentBrandDiscounts) {
//            $this->details[] = array();
            foreach ($componentBrandDiscounts as $componentBrandDiscount) {
                $estimationBrandDiscount = new EstimationBrandDiscount();
                $estimationBrandDiscount->value_1 = $componentBrandDiscount->value_1;
                $estimationBrandDiscount->value_2 = $componentBrandDiscount->value_2;
                $estimationBrandDiscount->value_3 = $componentBrandDiscount->value_3;
                $estimationBrandDiscount->value_4 = $componentBrandDiscount->value_4;
                $estimationBrandDiscount->value_5 = $componentBrandDiscount->value_5;
                $estimationBrandDiscount->component_brand_discount_id = $componentBrandDiscount->id;
                $estimationBrandDiscount->name = $componentBrandDiscount->componentBrand->name;
                $estimationBrandDiscount->isPrimary = $componentBrandDiscount->is_primary;
                if ($componentBrandDiscount->currency_id != NULL) {
                    $estimationBrandDiscount->currentRate = $componentBrandDiscount->currency->rate;
                    $estimationBrandDiscount->currency_id = $componentBrandDiscount->currency_id;
                    $estimationBrandDiscount->estimation_currency_id = $componentBrandDiscount->currency_id;
                }
                $this->details[] = $estimationBrandDiscount;
            }
        }
    }

    public function addDetail($brandid) {
        $brand = Brand::model()->findByPk($brandid);
        if ($brand != NULL) {
            $exist = false;

            // Check Duplicate
            foreach ($this->detailComponents as $detail) {
                if ($detail->brand_id == $brandid) {
                    $exist = TRUE;
                    break;
                }
            }
            // add row if not exist
            if (!$exist) {
                $detail = new EstimationBrandDiscount();
                $detail->brand_id = $brandid;
                $this->details[] = $detail;
            }
        }
    }

    public function addDetailComponent($index, $componentId) {

        $component = Component::model()->findByPk($componentId);

        if ($component != NULL) {

            $detail = new EstimationComponent();
            $detail->component_id = $component->id;

            $price = 0;

            if ($component->component_brand_discount_id != NULL) {
                foreach ($this->details as $estimationBrandDiscount) {
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
            $detail->estimation_panel_id = $index;
            $this->detailComponents[] = $detail;
        }
    }

    public function addDetailAccesories($index, $componentId) {

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
                    foreach ($this->details as $estimationBrandDiscount) {
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
                $detail->estimation_panel_id = $index;
                $this->detailAccesories[] = $detail;
            }
        }
    }

    public function addDetailAccesoriesCu($index, $componentId) {

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
                    foreach ($this->details as $estimationBrandDiscount) {
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

                $detail->basic_price = $price;
                $detail->weight = $componentCu->weight;
                $detail->estimation_panel_id = $index;
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
        $valid = $this->header->save(false);

        foreach ($this->estimationCurrencies as $estimationCurrency) {
            if ($estimationCurrency->isNewRecord)
                $estimationCurrency->estimation_header_id = $this->header->id;

            $valid = $estimationCurrency->save(false) && $valid;
        }

        if ($valid) {
            $estimationCurrencyCurrent = EstimationCurrency::model()->findAll(array('order' => 'id DESC'));

            if ($estimationCurrencyCurrent) {
                $currencies = array();
                for ($i = 0; $i < 2; $i++) {
                    $currencies[] = $estimationCurrencyCurrent[$i];
                }
            }
        }

        foreach ($this->details as $detail) {

            if ($detail->isNewRecord)
                $detail->estimation_header_id = $this->header->id;

            if ($detail->estimation_currency_id != NULL) {
                foreach ($currencies as $currency)
                    if ($currency->currency_id == $detail->estimation_currency_id)
                        $detail->estimation_currency_id = $currency->id;
            }

            $valid = $detail->save(false) && $valid;
        }

        if ($valid) {
            $estimationBrandDiscountCurrent = EstimationBrandDiscount::model()->findAll(array('order' => 'id DESC'));

            if ($estimationCurrencyCurrent) {
                $brandDiscounts = array();
                for ($i = 0; $i < 48; $i++) {
                    $brandDiscounts[] = $estimationBrandDiscountCurrent[$i];
                }
            }
        }

        foreach ($this->panels as $panel) {
            if ($panel->isNewRecord)
                $panel->estimation_header_id = $this->header->id;

            $valid = $panel->save(false) && $valid;
        }

        foreach ($this->detailComponents as $detailComponent) {

            $indexComponent = $detailComponent->estimation_panel_id;
            $detailComponent->estimation_panel_id = $this->panels[$indexComponent]->id;

            if ($detailComponent->component->component_brand_discount_id != NULL) {
                foreach ($brandDiscounts as $brandDiscount)
                    if ($brandDiscount->component_brand_discount_id == $detailComponent->component->component_brand_discount_id)
                        $detailComponent->estimation_brand_discount_id = $brandDiscount->id;
            }
            if ($detailComponent->accesories_phase_id != NULL)
                $detailComponent->accesories_phase_value = $detailComponent->accesoriesPhase->value;

            $valid = $detailComponent->save(false) && $valid;
        }


        if ($this->detailAccesories != NULL)
            foreach ($this->detailAccesories as $detailAccesory) {

                $indexAccesory = $detailAccesory->estimation_panel_id;
                $detailAccesory->estimation_panel_id = $this->panels[$indexAccesory]->id;

                if ($detailAccesory->component_id != NULL) {
                    if ($detailAccesory->component->component_brand_discount_id != NULL) {
                        foreach ($brandDiscounts as $brandDiscount)
                            if ($brandDiscount->component_brand_discount_id == $detailAccesory->component->component_brand_discount_id)
                                $detailAccesory->estimation_brand_discount_id = $brandDiscount->id;
                    }
                }else {
                    if ($detailAccesory->componentCu->component_brand_discount_id != NULL) {
                        foreach ($brandDiscounts as $brandDiscount)
                            if ($brandDiscount->component_brand_discount_id == $detailAccesory->componentCu->component_brand_discount_id)
                                $detailAccesory->estimation_brand_discount_id = $brandDiscount->id;
                    }
                }

                if ($detailAccesory->accesories_phase_id != NULL)
                    $detailAccesory->accesories_phase_value = $detailAccesory->accesoriesPhase->value;

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

    public function flushHeader() {

        $valid = true;

//        if ($this->header->isNewRecord) {
//            $estimationHeaderHistory = new EstimationHeaderHistory();
//            $estimationHeaderHistory->attributes = $this->header->attributes;
//            $estimationHeaderHistory->estimation_header_id = $this->header->id;
//            $valid = $estimationHeaderHistory->save(false) && $valid;
//        } else {
//            $estimationHeaderCurrent = EstimationHeader::model()->findByPk($this->header->id);
//            if ($estimationHeaderCurrent->attributes != $this->header->attributes) {
//                $estimationHeaderHistory = new EstimationHeaderHistory();
//                $estimationHeaderHistory->attributes = $this->header->attributes;
//                $estimationHeaderHistory->estimation_header_id = $this->header->id;
//                $valid = $estimationHeaderHistory->save(false) && $valid;
//            }
//        }

        $valid = $this->header->save(false) && $valid;

//        foreach ($this->estimationCurrencies as $estimationCurrency) {
//            if ($estimationCurrency->isNewRecord)
//                $estimationCurrency->estimation_header_id = $this->header->id;
//
//            if ($estimationCurrency->isNewRecord) {
//                $estimationCurrencyHistory = new EstimationCurrencyHistory();
//                $estimationCurrencyHistory->attributes = $estimationCurrency->attributes;
//                $valid = $estimationCurrencyHistory->save(false) && $valid;
//            } else {
//                $estimationCurrencyCurrent = EstimationCurrency::model()->findByPk($estimationCurrency->id);
//                if ($estimationCurrencyCurrent->attributes != $estimationCurrency->attributes) {
//                    $estimationCurrencyHistory = new EstimationCurrencyHistory();
//                    $estimationCurrencyHistory->attributes = $estimationCurrency->attributes;
//                    $valid = $estimationCurrencyHistory->save(false) && $valid;
//                }
//            }
//
//            $valid = $estimationCurrency->save(false) && $valid;
//        }
//
//
//        if ($valid) {
//            $estimationCurrencyCurrent = EstimationCurrency::model()->findAll(array('order' => 'id DESC'));
//
//            if ($estimationCurrencyCurrent) {
//                $currencies = array();
//                for ($i = 0; $i < 2; $i++) {
//                    $currencies[] = $estimationCurrencyCurrent[$i];
//                }
//            }
//        }
//
//        foreach ($this->details as $detail) {
//
//            if ($detail->isNewRecord)
//                $detail->estimation_header_id = $this->header->id;
//
//            if ($detail->estimation_currency_id != NULL) {
//                foreach ($currencies as $currency)
//                    if ($currency->currency_id == $detail->estimation_currency_id)
//                        $detail->estimation_currency_id = $currency->id;
//            }
//
//
//            if ($detail->isNewRecord) {
//                $estimationBrandDiscountHistory = new EstimationBrandDiscountHistory();
//                $estimationBrandDiscountHistory->attributes = $detail->attributes;
//                $valid = $estimationBrandDiscountHistory->save(false) && $valid;
//            } else {
//                $estimationBrandDiscountCurrent = EstimationBrandDiscount::model()->findByPk($detail->id);
//                if ($estimationBrandDiscountCurrent->attributes != $detail->attributes) {
//                    $estimationBrandDiscountHistory = new EstimationBrandDiscountHistory();
//                    $estimationBrandDiscountHistory->attributes = $detail->attributes;
//                    $valid = $estimationBrandDiscountHistory->save(false) && $valid;
//                }
//            }
//
//            $valid = $detail->save(false) && $valid;
//        }
//
//        if ($valid) {
//            $estimationBrandDiscountCurrent = EstimationBrandDiscount::model()->findAll(array('order' => 'id DESC'));
//
//            if ($estimationCurrencyCurrent) {
//                $brandDiscounts = array();
//                for ($i = 0; $i < 48; $i++) {
//                    $brandDiscounts[] = $estimationBrandDiscountCurrent[$i];
//                }
//            }
//        }

        foreach ($this->panels as $detail) {
            if ($detail->isNewRecord)
                $detail->estimation_header_id = $this->header->id;
            $valid = $detail->save(false) && $valid;
        }

        return $valid;
    }

    public function saveHeader($dbConnection) {
        $dbTransaction = $dbConnection->beginTransaction();
        try {
            $valid = $this->validateHeader() && $this->flushHeader();
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

        if (/* count($this->details) === 0 || */ count($this->panels) === 0)
            $valid = false;

        return $valid;
    }

    public function validate() {
        $valid = $this->header->validate();

        if (!$valid)
            $this->header->addError('error', 'Header Error');
        else {
            $valid = $valid && $this->count();
            if (!$valid)
                $this->header->addError('error', 'Salah satu form tidak terisi baik diskon atau panel');
        }

        if (/* count($this->details) > 0  && */ count($this->panels) > 0) {
            foreach ($this->panels as $detail) {
                $fields = array('panel_name', 'sale_order_detail_id');
                $valid = $valid && $detail->validate($fields);
            }
        }
        else
            $valid = false;

        return $valid;
    }

    public function validateHeader() {
        $valid = $this->header->validate();

        if (!$valid)
            $this->header->addError('error', 'Header Error');
        else {
            $valid = $valid && $this->countHeader();
            if (!$valid)
                $this->header->addError('error', 'Diskon tidak boleh kosong');
        }

//        if (count($this->details) > 0) {
//            foreach ($this->details as $detail) {
//                $fields = array('name');
//                $valid = $valid && $detail->validate($fields);
//            }
//        }
//        else
//            $valid = false;

        return $valid;
    }

    public function countHeader() {
        $valid = true;

        if (count($this->panels) === 0)
            $valid = false;

        return $valid;
    }

}
