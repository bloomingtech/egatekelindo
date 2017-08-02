<?php

class PackingList extends CComponent {

    public $header;
    public $details;

    public function __construct($header, array $details) {
        $this->header = $header;
        $this->details = $details;
    }

    public function generateCodeNumber($currentMonth, $currentYear) {
        $packingListHeader = PackingListHeader::model()->find(array(
            'order' => 'id DESC',
                ));

        if ($packingListHeader !== null)
            $this->header->setCodeNumber($packingListHeader->cn_ordinal, $packingListHeader->cn_month, $packingListHeader->cn_year);

        $this->header->setCodeNumberByNext($currentMonth, $currentYear);
    }

    public function addDetailByPartList($id) {
        $sql = SqlViewGenerator::partListQuantityRemaining() . "
				WHERE p.part_list_header_id = :part_list_header_id
				HAVING quantity_partListed > 0
				ORDER BY p.id";

        $resultSet = Yii::app()->db->createCommand($sql)->queryAll(true, array(':part_list_header_id' => $id));

        $this->details = array();

        foreach ($resultSet as $row) {
            $detail = new PackingListDetail();
            $detail->part_list_detail_id = $row['part_list_detail_id'];
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
                $fields = array('quantity', 'part_list_detail_id');
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

                if ($this->details[$i]->part_list_detail_id === $this->details[$j]->part_list_detail_id) {
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
                $detail->packing_list_header_id = $this->header->id;
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
