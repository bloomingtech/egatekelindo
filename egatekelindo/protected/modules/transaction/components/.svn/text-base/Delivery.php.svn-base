//<?php

class Delivery extends CComponent {

    public $header;
    public $details;

    public function __construct($header, array $details) {
        $this->header = $header;
        $this->details = $details;
    }

    public function generateCodeNumber($currentMonth, $currentYear) {
        $deliveryHeader = DeliveryHeader::model()->find(array(
            'order' => 'id DESC',
                ));

        if ($deliveryHeader !== null)
            $this->header->setCodeNumber($deliveryHeader->cn_ordinal, $deliveryHeader->cn_month, $deliveryHeader->cn_year);

        $this->header->setCodeNumberByNext($currentMonth, $currentYear);
    }

    public function addDetail() {
        $detail = new DeliveryDetail();
        $this->details[] = $detail;
    }

    public function removeDetailAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function validate() {
        $valid = $this->header->validate();

        $valid = $valid && $this->validateDetailsCount();

        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
                $fields = array('quantity');
                $valid = $valid && $detail->validate($fields);
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

    public function flush() {
        $valid = $this->header->save(false);

        //counter for skipping because zero qutntity user input
        foreach ($this->details as $detail) {
            if ($detail->quantity <= 0) {
                continue;
            }

            if ($detail->isNewRecord) {
                $detail->delivery_header_id = $this->header->id;
                $valid = $valid && $detail->save(false);
            } else {
                if ((int) $detail->is_inactive === 1 && !$this->header->saleInvoices) {
                    $detail->delete();
                    continue;
                }
                else
                    $valid = $valid && $detail->save(false);
            }
        }

        return $valid;
    }

}
