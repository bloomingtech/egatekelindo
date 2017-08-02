<?php

class SalePayment extends CComponent {

    public $header;
    public $details;

    public function __construct($header, array $details) {
        $this->header = $header;
        $this->details = $details;
    }

    public function generateCodeNumber($currentMonth, $currentYear) {
        $salePaymentHeader = SalePaymentHeader::model()->find(array(
            'order' => 'id DESC',
                ));

        if ($salePaymentHeader !== null)
            $this->header->setCodeNumber($salePaymentHeader->cn_ordinal, $salePaymentHeader->cn_month, $salePaymentHeader->cn_year);

        $this->header->setCodeNumberByNext($currentMonth, $currentYear);
    }

    public function addDetail($id) {
        $saleInvoice = SaleInvoiceHeader::model()->findByPk($id);

        if ($saleInvoice !== null) {
            $exist = false;
            foreach ($this->details as $i => $detail) {
                if ($saleInvoice->id === $detail->sale_invoice_header_id) {
                    $exist = true;
                    break;
                }
            }

            if (!$exist) {
                $detail = new SalePaymentDetail();
                $detail->sale_invoice_header_id = $saleInvoice->id;
                $this->details[] = $detail;
            }
        }
    }

    public function resetDetail() {
        $this->details = array();
    }

    public function removeDetailAt($index) {
        array_splice($this->details, $index, 1);
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

    public function validate() {
        $valid = $this->header->validate();

        $valid = $valid && $this->validateDetailsCount();
        $valid = $valid && $this->validateDetailsUnique();

        if ($valid) {
            foreach ($this->details as $detail) {
                $fields = array('amount', 'sale_invoice_header_id');
                $valid = $valid && $detail->validate($fields);
            }
        }

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

    public function validateDetailsUnique() {
        $valid = true;

        $detailsCount = count($this->details);
        for ($i = 0; $i < $detailsCount; $i++) {
            for ($j = $i; $j < $detailsCount; $j++) {
                if ($i === $j)
                    continue;

                if ($this->details[$i]->sale_invoice_header_id === $this->details[$j]->sale_invoice_header_id) {
                    $valid = false;
                    $this->header->addError('error', 'Nomor invoice tidak boleh sama.');
                    break;
                }
            }
        }

        return $valid;
    }

    public function flush() {
        $this->header->grand_total = $this->getGrandTotal();
        $valid = $this->header->save(false);

        if (!empty($this->details)) {
            foreach ($this->details as $detail) {
                if ($detail->amount <= 0)
                    continue;

                if ($detail->isNewRecord) {
                    $detail->sale_payment_header_id = $this->header->id;
                    $valid = $valid && $detail->save(false);
                } else {
                    if ((int) $detail->is_inactive === 1)
                        $valid = $valid && $detail->delete();
                    else
                        $valid = $valid && $detail->save(false);
                }
            }
        }
        return $valid;
    }

    public function getTotalDetailInvoice() {
        $total = 0.00;

        foreach ($this->details as $detail)
            $total += $detail->totalInvoice;

        return $total;
    }

    public function getTotalSaleReturn() {
        $total = 0.00;

        foreach ($this->details as $detail)
            $total += $detail->totalReturn;

        return $total;
    }

    public function getTotalPayment() {
        $payment = 0.00;

        foreach ($this->details as $detail)
            $payment += $detail->totalPayment;

        return $payment;
    }

    public function getTotalInvoicePaid() {
        return $this->getTotalDetailInvoice() - $this->getTotalSaleReturn() - $this->getTotalPayment();
    }

    public function getTotalAmount() {
        $total = 0.00;

        foreach ($this->details as $detail)
            $total += $detail->amount;

        return $total;
    }

    public function getGrandTotal() {
        $returnTotal = $this->header->sale_return_header_id ? $this->header->saleReturnHeader->grand_total : 0;

        return $this->getTotalAmount() - $returnTotal;
    }

    public function getRemaining() { //remaining = total invoice - has paid - total return - current payment
        if ($this->header->saleReturnHeader !== null)
            return $this->totalInvoicePaid - $this->header->saleReturnHeader->grandTotal - $this->getTotalAmount();
        else
            return $this->totalInvoicePaid - $this->getTotalAmount();
    }

}
