<?php

class Receive extends CComponent {

    public $header;
    public $details;

    public function __construct($header, array $details) {
        $this->header = $header;
        $this->details = $details;
    }

    public function generateCodeNumber($currentMonth, $currentYear) {
        $receiveHeader = ReceiveHeader::model()->find(array(
            'order' => 'id DESC',
                ));

        if ($receiveHeader !== null)
            $this->header->setCodeNumber($receiveHeader->cn_ordinal, $receiveHeader->cn_month, $receiveHeader->cn_year);

        $this->header->setCodeNumberByNext($currentMonth, $currentYear);
    }

    public function addDetails($id) {
        $this->details = array();
        
        if ($this->header->purchaseHeader->is_purchase_request === 1) {
            $purchaseDetailRequests = PurchaseDetailRequest::model()->findAllByAttributes(array('purchase_header_id' => $id));

            foreach ($purchaseDetailRequests as $purchaseDetailRequest) {
                $detail = new ReceiveDetail();
                $detail->purchase_detail_request_id = $purchaseDetailRequest->id;
                $detail->purchase_detail_requirement_id = NULL;
                $detail->component_id = $purchaseDetailRequest->purchaseRequestDetailComponent->component_id;
                $this->details[] = $detail;
            }
        }
        else {
            $purchaseDetailRequirements = PurchaseDetailRequirement::model()->findAllByAttributes(array('purchase_header_id' => $id));

            foreach ($purchaseDetailRequirements as $purchaseDetailRequirement) {
                $detail = new ReceiveDetail();
                $detail->purchase_detail_request_id = NULL;
                $detail->purchase_detail_requirement_id = $purchaseDetailRequirement->id;
                $detail->component_id = $purchaseDetailRequirement->requirementDetailComponent->component_id;
                $this->details[] = $detail;
            }
        }
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
                $detail->receive_header_id = $this->header->id;
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
