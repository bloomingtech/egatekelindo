<?php

class ExpenseHeader extends ExpenseHeaderBase {
    const CN_CONSTANT_CASH = 'EXPC';
    const CN_CONSTANT_BANK = 'EXPB';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getTotal() {
        $total = 0.00;

        foreach ($this->expenseDetails as $detail) {
            if ($detail->is_inactive == 0)
                $total += $detail->amount;
        }

        return $total;
    }

}