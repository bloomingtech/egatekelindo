<?php

class MaterialCheckout extends CComponent {

    public $header;
    public $details;

    public function __construct($header, array $details) {
        $this->header = $header;
        $this->details = $details;
    }

    public function generateCodeNumber($currentMonth, $currentYear) {
        $materialCheckoutHeader = MaterialCheckoutHeader::model()->find(array(
            'order' => 'id DESC',
                ));

        if ($materialCheckoutHeader !== null)
            $this->header->setCodeNumber($materialCheckoutHeader->cn_ordinal, $materialCheckoutHeader->cn_month, $materialCheckoutHeader->cn_year);

        $this->header->setCodeNumberByNext($currentMonth, $currentYear);
    }

    public function addDetailByPackingList($id) {
        $packingListHeader = PackingListHeader::model()->findByPk($id);

        $this->details = array();

        foreach ($packingListHeader->packingListDetails as $packingListDetail) {
            $detail = new MaterialCheckoutDetail();
            $detail->packing_list_detail_id = $packingListDetail->id;
            $detail->quantity = $packingListDetail->quantity;
            $this->details[] = $detail;
        }
    }

    public function removeDetailAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function validate() {
        $valid = $this->header->validate();

        $valid = $valid && $this->validateDetailsCount();
        $valid = $valid && $this->validateDetailsUnique();

        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
                $fields = array('quantity', 'packing_list_detail_id');
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

    public function validateDetailsUnique() {
        $valid = true;

        $detailsCount = count($this->details);
        for ($i = 0; $i < $detailsCount; $i++) {
            for ($j = $i; $j < $detailsCount; $j++) {
                if ($i === $j)
                    continue;

                if ($this->details[$i]->packing_list_detail_id === $this->details[$j]->packing_list_detail_id) {
                    $valid = false;
                    $this->header->addError('error', 'detail penjualan tidak boleh sama.');
                    break;
                }
            }
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
                $detail->material_checkout_header_id = $this->header->id;
                $valid = $valid && $detail->save(false);
            } else {
                if ((int) $detail->is_inactive === 1) {
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
