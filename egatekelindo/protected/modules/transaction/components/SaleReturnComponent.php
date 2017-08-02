<?php

class SaleReturnComponent extends CComponent {

    public $header;
    public $details;

    public function __construct($header, array $details) {
        $this->header = $header;
        $this->details = $details;
    }

    public function generateCodeNumber($currentMonth, $currentYear) {
        $saleReturnHeader = SaleReturnHeader::model()->find(array(
            'order' => 'id DESC',
                ));

        if ($saleReturnHeader !== null)
            $this->header->setCodeNumber($saleReturnHeader->cn_ordinal, $saleReturnHeader->cn_month, $saleReturnHeader->cn_year);

        $this->header->setCodeNumberByNext($currentMonth, $currentYear);
    }

    public function addDetail() {
        $detail = new SaleReturnDetail();
        $this->details[] = $detail;
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
            $this->header->addError('error', $e->getMessage());
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

    public function deleteItem($dbConnection) {
        $dbTransaction = $dbConnection->beginTransaction();
        try {
            $valid = true;

            foreach ($this->detailItems as $detail)
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
        if (!$valid)
            $this->header->addError('error', 'Header Error');
        else {
            $valid = $valid && $this->validateDetailsCount();
            if (!$valid)
                $this->header->addError('error', 'Validate Details Error');
        }

        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
                $fields = array('quantity', 'unit_price', 'item_description');

                $valid = $valid && $detail->validate($fields);
                if (!$valid)
                    $this->header->addError('error', 'Validate Details Error');
            }
        }
        else
            $valid = false;

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

    public function flush() {
        $this->header->tax = 10;
        $this->header->grand_total = $this->getGrandTotal();

        $valid = $this->header->save(false);

        foreach ($this->details as $detail) {
            if ($detail->quantity <= 0)
                continue;
            if ($detail->isNewRecord) {
                $detail->sale_return_header_id = $this->header->id;
                $valid = $valid && $detail->save(false);
            }
        }

        return $valid;
    }

    public function getSubTotal() {
        $total = 0.00;

        foreach ($this->details as $detail)
            $total += $detail->total;

        return $total;
    }

    public function getTaxTotal() {
        return $this->getSubTotal() * 0.1;
    }

    public function getGrandTotal() {
        return $this->getSubTotal() + $this->getTaxTotal() - $this->header->discount;
    }

}
