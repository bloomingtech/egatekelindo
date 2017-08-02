<?php

class PurchaseHeader extends PurchaseHeaderBase {
    const CN_CONSTANT = 'PO';

    const PAYMENT_TERM = 0;
    const CASH = 1;
    const PAYMENT_TERM_LITERAL = 'Hutang';
    const CASH_LITERAL = 'Cash';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getPaymentType()
    {
        return ($this->is_cash) ? self::CASH_LITERAL : self::PAYMENT_TERM_LITERAL;
    }

    public function getCodeNumber($cnConstant = '') {
        return sprintf('PO-%02d-%s-%s%03d', $this->cn_year, $this->cn_month, $this->purchasingType->code, $this->cn_ordinal);
    }

    public function getTotalQuantityRequirement() {
        $total = 0;

        foreach ($this->purchaseDetailRequirements as $detailRequirement) {
            if ($detailRequirement->is_inactive == 0)
                $total += $detailRequirement->quantity;
        }

        return $total;
    }

    public function getTotalWeightRequirement() {
        $total = 0;

        foreach ($this->purchaseDetailRequirements as $detailRequirement) {
            if ($detailRequirement->is_inactive == 0)
                $total += $detailRequirement->weight;
        }

        return $total;
    }

    public function getSubTotalRequirement() {
        $total = 0.00;

        foreach ($this->purchaseDetailRequirements as $detailRequirement) {
            if ($detailRequirement->is_inactive == 0)
                $total += $detailRequirement->totalAfterDiscount;
        }

        return $total;
    }

    public function getTaxPercentage() {
        return ((int) $this->is_tax === 1) ? 10 : 0;
    }

    public function getCalculatedTaxRequirement() {
        return $this->subTotalRequirement * ($this->taxPercentage / 100);
    }

    public function getGrandTotalRequirement() {
        return $this->subTotalRequirement + $this->calculatedTaxRequirement;
    }

    public function getTotalQuantityRequest() {
        $total = 0;

        foreach ($this->purchaseDetailRequests as $detailRequest) {
            if ($detailRequest->is_inactive == 0)
                $total += $detailRequest->quantity;
        }

        return $total;
    }

    public function getTotalWeightRequest() {
        $total = 0;

        foreach ($this->purchaseDetailRequests as $detailRequest) {
            if ($detailRequest->is_inactive == 0)
                $total += $detailRequest->weight;
        }

        return $total;
    }

    public function getSubTotalRequest() {
        $total = 0.00;

        foreach ($this->purchaseDetailRequests as $detailRequest) {
            if ($detailRequest->is_inactive == 0)
                $total += $detailRequest->totalAfterDiscount;
        }

        return $total;
    }

    public function getCalculatedTaxRequest() {
        return $this->subTotalRequest * ($this->taxPercentage / 100);
    }

    public function getGrandTotalRequest() {
        return $this->subTotalRequest + $this->calculatedTaxRequest;
    }

}