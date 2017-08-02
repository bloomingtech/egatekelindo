<?php

class PurchaseByRequirement extends CComponent {

    public $header;
    public $details;

    public function __construct($header, array $details) {
        $this->header = $header;
        $this->details = $details;
    }

    public function generateCodeNumber($currentMonth, $currentYear) {
        $purchaseHeader = PurchaseHeader::model()->find(array(
            'order' => 'id DESC',
                ));

        if ($purchaseHeader !== null)
            $this->header->setCodeNumber($purchaseHeader->cn_ordinal, $purchaseHeader->cn_month, $purchaseHeader->cn_year);

        $this->header->setCodeNumberByNext($currentMonth, $currentYear);
    }

    public function addDetails($id) {
//        $this->details = array();
//        $requirementDetails = RequirementDetail::model()->findAllByAttributes(array('requirement_header_id' => $id));
//
//        foreach ($requirementDetails as $requirementDetail) {
//            foreach ($requirementDetail->requirementDetailComponents as $requirementDetailComponent) {
//                $detail = new PurchaseDetailRequirement();
//                $detail->requirement_detail_component_id = $requirementDetailComponent->id;
//                $detail->unit_price = ($requirementDetailComponent->component_id === null) ? $requirementDetailComponent->unit_price : $requirementDetailComponent->component->budget_price;
//                $this->details[] = $detail;
//            }
//        }
        
        $sql = "SELECT p.id, p.unit_price, p.quantity - SUM(COALESCE(r.quantity, 0)) AS quantity_requested
                FROM " . RequirementDetailComponent::model()->tableName() . " p
                LEFT OUTER JOIN " . RequirementDetail::model()->tableName() . " d ON d.id = p.requirement_detail_id
                LEFT OUTER JOIN " . PurchaseDetailRequirement::model()->tableName() . " r ON p.id = r.requirement_detail_component_id AND r.is_inactive = 0 AND p.is_inactive = 0
                WHERE d.requirement_header_id = :requirement_header_id
                GROUP BY p.id
                HAVING quantity_requested > 0";

        $resultSet = CActiveRecord::$db->createCommand($sql)->queryAll(true, array(':requirement_header_id' => $id));
        $this->details = array();

        foreach ($resultSet as $row) {
            $detail = new PurchaseDetailRequirement();
            $detail->requirement_detail_component_id = $row['id'];
            $detail->quantity_requested = $row['quantity_requested'];
            $detail->unit_price = $row['unit_price'];
            $this->details[] = $detail;
        }
    }

    public function removeDetailAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function validate() {
        $valid = $this->header->validate();
        if (!$valid)
            $this->header->addError('error', 'Header error');

        $valid = $valid && $this->validateDetailsCount();

        if (!$valid)
            $this->header->addError('error', 'Details Count error');

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
            $valid = false;
            $this->header->addError('error', $e->getMessage());
            $dbTransaction->rollback();
        }

        return $valid;
    }

    public function flush() {
        $valid = $this->header->save(false);

        foreach ($this->details as $detail) {
            if ($detail->quantity <= 0)
                continue;

            if ($detail->isNewRecord)
                $detail->purchase_header_id = $this->header->id;

            $valid = $valid && $detail->save(false);
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

    public function getTotalQuantity() {
        $total = 0;

        foreach ($this->details as $detail) {
            if ($detail->is_inactive == 0)
                $total += $detail->quantity;
        }

        return $total;
    }

    public function getTotalWeight() {
        $total = 0;

        foreach ($this->details as $detail) {
            if ($detail->is_inactive == 0)
                $total += $detail->weight;
        }

        return $total;
    }

    public function getSubTotal() {
        $total = 0.00;

        foreach ($this->details as $detail) {
            if ($detail->is_inactive == 0)
                $total += $detail->totalAfterDiscount;
        }

        return $total;
    }

    public function getTaxPercentage() {
        return ((int) $this->header->is_tax === 1) ? 10 : 0;
    }

    public function getCalculatedTax() {
        return $this->subTotal * ($this->taxPercentage / 100);
    }

    public function getGrandTotal() {
        return $this->subTotal + $this->calculatedTax;
    }

}
