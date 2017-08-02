<?php

class BudgetingDetailAccesories extends BudgetingDetailAccesoriesBase {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getTotal() {
        $total = $this->unit_price * $this->quantity * $this->weight;

        if ($this->budgeting_brand_discount_id) {
            if ($this->budgetingBrandDiscount->value_1 > 0) {
                if ($this->budgetingBrandDiscount->value_calculation_type_1 == 1)
                    $total = $total * $this->budgetingBrandDiscount->value_1;
                else if ($this->budgetingBrandDiscount->value_calculation_type_1 == 2)
                    $total = $total / $this->budgetingBrandDiscount->value_1;
                else if ($this->budgetingBrandDiscount->value_calculation_type_1 == 3)
                    $total = $total - $this->budgetingBrandDiscount->value_1;
            }

            if ($this->budgetingBrandDiscount->value_2 > 0) {
                if ($this->budgetingBrandDiscount->value_calculation_type_2 == 1)
                    $total = $total * $this->budgetingBrandDiscount->value_2;
                else if ($this->budgetingBrandDiscount->value_calculation_type_2 == 2)
                    $total = $total / $this->budgetingBrandDiscount->value_2;
                else if ($this->budgetingBrandDiscount->value_calculation_type_2 == 3)
                    $total = $total - $this->budgetingBrandDiscount->value_2;
            }

            if ($this->budgetingBrandDiscount->value_3 > 0) {
                if ($this->budgetingBrandDiscount->value_calculation_type_3 == 1)
                    $total = $total * $this->budgetingBrandDiscount->value_3;
                else if ($this->budgetingBrandDiscount->value_calculation_type_3 == 2)
                    $total = $total / $this->budgetingBrandDiscount->value_3;
                else if ($this->budgetingBrandDiscount->value_calculation_type_3 == 3)
                    $total = $total - $this->budgetingBrandDiscount->value_3;
            }

            if ($this->budgetingBrandDiscount->value_4 > 0) {
                if ($this->budgetingBrandDiscount->value_calculation_type_4 == 1)
                    $total = $total * $this->budgetingBrandDiscount->value_4;
                else if ($this->budgetingBrandDiscount->value_calculation_type_4 == 2)
                    $total = $total / $this->budgetingBrandDiscount->value_4;
                else if ($this->budgetingBrandDiscount->value_calculation_type_4 == 3)
                    $total = $total - $this->budgetingBrandDiscount->value_4;
            }


            if ($this->budgetingBrandDiscount->budgetingCurrency)
                $total = $total * $this->budgetingBrandDiscount->budgetingCurrency->value;

            return $total;
        }

        else
            return $total;
    }

}