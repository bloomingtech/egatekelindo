<?php

class Budget extends CComponent {

    public $header; // Table budgeting header
    public $details; //Table budgeting detail
    public $panels; // Table estimation panel
    public $discounts; // table estimation brand discount    
    public $budgetingCurrencies; // Table budgeting currency
    public $budgetingBrandDiscounts; // Table budgeting brand discount

    public function __construct($header, array $details, array $panels, array $discounts, array $budgetingCurrencies, array $budgetingBrandDiscounts) {
        $this->header = $header;
        $this->details = $details;
        $this->panels = $panels;
        $this->discounts = $discounts;
        $this->budgetingCurrencies = $budgetingCurrencies;
        $this->budgetingBrandDiscounts = $budgetingBrandDiscounts;
    }

    public function generateCodeNumber() {
        $criteria = new CDbCriteria();
        $criteria->order = 't.id DESC';
        $budgetLast = BudgetingHeader::model()->find($criteria);


        if ($budgetLast !== null)
            $this->header->setCodeNumber(
                    $budgetLast->cn_ordinal, $budgetLast->cn_month, $budgetLast->cn_year);
        $this->header->setCodeNumberByNext(date('m'), date('y'));
    }

    public function addBudgetingCurrencies() {
        $currencies = Currency::model()->findAll();

        if ($currencies) {
            foreach ($currencies as $currency) {
                $budgetingCurrency = new BudgetingCurrency();
                $budgetingCurrency->currency_id = $currency->id;
                $budgetingCurrency->value = $currency->rate;
                $this->budgetingCurrencies[] = $budgetingCurrency;
            }
        }
    }

    public function addBudgetingBrandDiscounts() {
        $componentBrandDiscounts = ComponentBrandDiscount::model()->findAll();

        if ($componentBrandDiscounts) {
            foreach ($componentBrandDiscounts as $componentBrandDiscount) {
                $budgetingBrandDiscount = new BudgetingBrandDiscount();
                $budgetingBrandDiscount->value_1 = $componentBrandDiscount->value_1;
                $budgetingBrandDiscount->value_2 = $componentBrandDiscount->value_2;
                $budgetingBrandDiscount->value_3 = $componentBrandDiscount->value_3;
                $budgetingBrandDiscount->value_4 = $componentBrandDiscount->value_4;
                $budgetingBrandDiscount->value_calculation_type_1 = $componentBrandDiscount->value_calculation_type_1;
                $budgetingBrandDiscount->value_calculation_type_2 = $componentBrandDiscount->value_calculation_type_2;
                $budgetingBrandDiscount->value_calculation_type_3 = $componentBrandDiscount->value_calculation_type_3;
                $budgetingBrandDiscount->value_calculation_type_4 = $componentBrandDiscount->value_calculation_type_4;
                $budgetingBrandDiscount->component_brand_discount_id = $componentBrandDiscount->id;
                $budgetingBrandDiscount->name = $componentBrandDiscount->componentBrand->name;
                $budgetingBrandDiscount->isPrimary = $componentBrandDiscount->is_primary;
                if ($componentBrandDiscount->currency_id != NULL) {
                    $budgetingBrandDiscount->currentRate = $componentBrandDiscount->currency->rate;
                    $budgetingBrandDiscount->currency_id = $componentBrandDiscount->currency_id;
                    $budgetingBrandDiscount->budgeting_currency_id = $componentBrandDiscount->currency_id;
                }
                $this->budgetingBrandDiscounts[] = $budgetingBrandDiscount;
            }
        }
    }

    public function flush() {
        $valid = $this->header->save(false);

//        foreach ($this->details as $detail) {
//            if ($detail->isNewRecord)
//                $detail->budgeting_header_id = $this->header->id;
//
//            $valid = $detail->save(false) && $valid;
//        }


        foreach ($this->budgetingCurrencies as $budgetingCurrency) {
            if ($budgetingCurrency->isNewRecord)
                $budgetingCurrency->budgeting_header_id = $this->header->id;


            $valid = $budgetingCurrency->save(false) && $valid;
        }


        if ($valid) {
            $budgetingCurrencyCurrent = BudgetingCurrency::model()->findAll(array('order' => 'id DESC'));

            if ($budgetingCurrencyCurrent) {
                $currencies = array();
                for ($i = 0; $i < 2; $i++) {
                    $currencies[] = $budgetingCurrencyCurrent[$i];
                }
            }
        }

        foreach ($this->budgetingBrandDiscounts as $budgetingBrandDiscount) {

            if ($budgetingBrandDiscount->isNewRecord)
                $budgetingBrandDiscount->budgeting_header_id = $this->header->id;

            if ($budgetingBrandDiscount->budgeting_header_id != NULL) {
                foreach ($currencies as $currency)
                    if ($currency->currency_id == $budgetingBrandDiscount->budgeting_currency_id)
                        $budgetingBrandDiscount->budgeting_currency_id = $currency->id;
            }

            $valid = $budgetingBrandDiscount->save(false) && $valid;
        }

        $saleOrderHeader = SaleOrderHeader::model()->findByPk($this->header->sale_order_header_id);
        $estimationHeader = EstimationHeader::model()->findByAttributes(array('sale_order_header_id' => $this->header->sale_order_header_id));

        foreach ($estimationHeader->estimationPanels as $estimationPanel) {
            foreach ($estimationPanel->estimationComponents as $estimationComponent) {
//                foreach ($saleOrderHeader->saleOrderDetails as $saleOrderDetail) {
//                    if ($estimationPanel->panel_name == $saleOrderDetail->panel_name) {

				$budgetingDetail = new BudgetingDetail();
				$budgetingDetail->budgeting_header_id = $this->header->id;
				$budgetingDetail->component_name = $estimationComponent->name;
				$budgetingDetail->quantity = $estimationComponent->quantity;
				$budgetingDetail->component_id = $estimationComponent->component_id;
				$budgetingDetail->unit_price = $estimationComponent->component->budget_price;
				$budgetingDetail->type = $estimationComponent->type;
				$budgetingDetail->brand_name = $estimationComponent->brand->name;
				$budgetingDetail->estimation_component_id = $estimationComponent->id;
				$budgetingDetail->sale_order_detail_id = $estimationPanel->sale_order_detail_id;

				foreach ($this->budgetingBrandDiscounts as $budgetingBrandDiscount)
					if ($budgetingBrandDiscount->component_brand_discount_id == $estimationComponent->component->component_brand_discount_id)
						$budgetingDetail->budgeting_brand_discount_id = $budgetingBrandDiscount->id;

				$valid = $budgetingDetail->save(false) && $valid;
//                    }
//                }
            }
            foreach ($estimationPanel->estimationComponentAccesories as $estimationComponentAccesory) {
//                foreach ($saleOrderHeader->saleOrderDetails as $saleOrderDetail) {
//                    if ($estimationPanel->panel_name == $saleOrderDetail->panel_name) {
                        $budgetingDetailAccesories = new BudgetingDetailAccesories();
                        $budgetingDetailAccesories->budgeting_header_id = $this->header->id;
                        $budgetingDetailAccesories->component_cu_id = $estimationComponentAccesory->component_cu_id;
                        $budgetingDetailAccesories->component_name = $estimationComponentAccesory->name;
                        $budgetingDetailAccesories->quantity = $estimationComponentAccesory->quantity;
                        $budgetingDetailAccesories->unit_price = $estimationComponentAccesory->unit_price;
                        $budgetingDetailAccesories->weight = $estimationComponentAccesory->weight;
						$budgetingDetailAccesories->estimation_component_accesories_id = $estimationComponentAccesory->id;
                        $budgetingDetailAccesories->sale_order_detail_id = $estimationPanel->sale_order_detail_id;

//                        foreach ($this->budgetingBrandDiscounts as $budgetingBrandDiscount)
//                            if ($budgetingBrandDiscount->component_brand_discount_id == $estimationComponentAccesory->component->component_brand_discount_id)
//                                $budgetingDetailAccesories->budgeting_brand_discount_id = $budgetingBrandDiscount->id;

                        $valid = $budgetingDetailAccesories->save(false) && $valid;
//                    }
//                }
            }
        }

        return $valid;
    }

    public function flushHeader() {
        $valid = $this->header->save(false);

        foreach ($this->budgetingCurrencies as $budgetingCurrency) {
            if ($budgetingCurrency->isNewRecord)
                $budgetingCurrency->budgeting_header_id = $this->header->id;


            $valid = $budgetingCurrency->save(false) && $valid;
        }


        if ($valid) {
            $budgetingCurrencyCurrent = BudgetingCurrency::model()->findAll(array('order' => 'id DESC'));

            if ($budgetingCurrencyCurrent) {
                $currencies = array();
                for ($i = 0; $i < 2; $i++) {
                    $currencies[] = $budgetingCurrencyCurrent[$i];
                }
            }
        }

        foreach ($this->budgetingBrandDiscounts as $budgetingBrandDiscount) {

            if ($budgetingBrandDiscount->isNewRecord)
                $budgetingBrandDiscount->budgeting_header_id = $this->header->id;

            if ($budgetingBrandDiscount->budgeting_header_id != NULL) {
                foreach ($currencies as $currency)
                    if ($currency->currency_id == $budgetingBrandDiscount->budgeting_currency_id)
                        $budgetingBrandDiscount->budgeting_currency_id = $currency->id;
            }

            $valid = $budgetingBrandDiscount->save(false) && $valid;
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

    public function saveHeader($dbConnection) {
        $dbTransaction = $dbConnection->beginTransaction();
        try {
            $valid = $this->validate() && $this->flushHeader();
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

    public function validate() {
        $validOrdinal = TRUE;
        $headerValidate = BudgetingHeader::model()->findByAttributes(array('cn_ordinal' => $this->header->cn_ordinal, 'cn_month' => $this->header->cn_month, 'cn_year' => $this->header->cn_year));
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


        if (count($this->budgetingBrandDiscounts) > 0) {
            foreach ($this->budgetingBrandDiscounts as $detail) {
                $fields = array('name');
                $valid = $valid && $detail->validate($fields);
            }
        }
        else
            $valid = false;

        return $valid;
    }

    public function resetDiscount() {
        $this->discounts = array();
    }

    public function resetPanel() {
        $this->panels = array();
        $this->details = array();
    }

    public function addDiscount($estimationHeaderid) {
        $estimationBrandDiscounts = EstimationBrandDiscount::model()->findAllByAttributes(array(
            'estimation_header_id' => $estimationHeaderid
                ));

        foreach ($estimationBrandDiscounts as $estimationBrandDiscount) {
            $this->discounts[] = $estimationBrandDiscount;
        }
    }

    public function addPanel($estimationHeaderid) {
        $estimationPanels = EstimationPanel::model()->findAllByAttributes(array(
            'estimation_header_id' => $estimationHeaderid
                ));

        foreach ($estimationPanels as $estimationPanel) {
            $this->panels[] = $estimationPanel;

            $estimationComponents = EstimationComponent::model()->findAllByAttributes(array(
                'estimation_panel_id' => $estimationPanel->id
                    ));

            foreach ($estimationComponents as $estimationComponent) {
                $detail = new BudgetingDetail();
                $detail->estimation_component_id = $estimationComponent->id;
                $this->details[] = $detail;
            }
        }
    }

}
