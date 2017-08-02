<?php

class SubconRequest extends CComponent {

    public $header;
    public $details;

    public function __construct($header, array $details) {
        $this->header = $header;
        $this->details = $details;
    }

    public function generateCodeNumber($currentMonth, $currentYear) {
        $subconRequestHeader = SubconRequestHeader::model()->find(array(
            'order' => 'id DESC',
                ));

        if ($subconRequestHeader !== null)
            $this->header->setCodeNumber($subconRequestHeader->cn_ordinal, $subconRequestHeader->cn_month, $subconRequestHeader->cn_year);

        $this->header->setCodeNumberByNext($currentMonth, $currentYear);
    }

    public function addDetail($id) {
        $component = Component::model()->findByPk($id);

        if ($component !== null) {
            $exist = false;
            foreach ($this->details as $i => $detail) {
                if ($component->id === $detail->component_id) {
                    $exist = true;
                    break;
                }
            }

            if (!$exist) {
                $detail = new SubconRequestDetail();
                $detail->component_id = $component->id;
                $this->details[] = $detail;
            }
        }
    }

    public function removeDetailAt($index) {
        array_splice($this->details, $index, 1);
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

                if ($this->details[$i]->component_id === $this->details[$j]->component_id) {
                    $valid = false;
                    $this->header->addError('error', 'Produk tidak boleh sama.');
                    break;
                }
            }
        }

        return $valid;
    }

    public function validate() {
        $valid = $this->header->validate();
        if (!$valid)
            $this->header->addError('error', 'Header error');

        $valid = $valid && $this->validateDetailsCount();
        if (!$valid)
            $this->header->addError('error', 'Details Count error');

        $valid = $valid && $this->validateDetailsUnique();
        if (!$valid)
            $this->header->addError('error', 'Details Unique error');


        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
                $fields = array('quantity', 'component_id');
                $valid = $valid && $detail->validate($fields);
            }
        }
        else
            $valid = false;

        return $valid;
    }

    public function flush() {
        $valid = $this->header->save(false);

        foreach ($this->details as $detail) {
            if ($detail->quantity <= 0)
                continue;

            if ($detail->isNewRecord) {
                $detail->subcon_request_header_id = $this->header->id;
                $valid = $valid && $detail->save(false);
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
            $valid = false;
            $this->header->addError('error', $e->getMessage());
            $dbTransaction->rollback();
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

}
