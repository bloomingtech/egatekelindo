<?php

class SaleOrderComponent extends CComponent {

    public $header;
    public $details;

    public function __construct($header, array $details) {
        $this->header = $header;
        $this->details = $details;
    }

    public function generateCodeNumber($isTax, $currentMonth, $currentYear) {
        $saleOrder = SaleOrderHeader::model()->find(array(
            'order' => 'id DESC',
            'condition' => 'is_tax = :is_tax',
            'params' => array(':is_tax' => $isTax),
                ));

        if ($saleOrder !== null)
            $this->header->setCodeNumber($saleOrder->cn_ordinal, $saleOrder->cn_month, $saleOrder->cn_year);

        $this->header->setCodeNumberByNext($currentMonth, $currentYear);
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

    public function validateDetailsCount() {
        $valid = true;
        if (count($this->details) === 0) {
            $valid = false;
            $this->header->addError('error', 'Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.');
        }

        return $valid;
    }

    public function validate() {
        $newCustomer = isset($_POST['SaleOrderHeader']['newCustomer']) ? $_POST['SaleOrderHeader']['newCustomer'] : '';

        if ($newCustomer == 0) {
            $customer = Customer::model()->findByPk($this->header->customer_id);
            if ($customer) {
                $this->header->client_name = $customer->name;
                $this->header->client_company = $customer->company;
                $this->header->phone = $customer->phone;
                $this->header->fax = $customer->fax ? $customer->fax : '-';
                $valid = 1;
            } else {
                $valid = 0;
            }
        } else {
            $customer = new Customer();
            $customer->name = $this->header->client_name;
            $customer->company = $this->header->client_company;
            $customer->phone = $this->header->phone;

            $valid = $customer->save(false);

            if ($valid) {
                $customerCurrent = Customer::model()->findAll(array('order' => 'id DESC'));
                $this->header->customer_id = $customerCurrent[0]->id;
            }
        }
        $validOrdinal = TRUE;
        $headerValidate = SaleOrderHeader::model()->findByAttributes(array('cn_ordinal' => $this->header->cn_ordinal, 'is_tax' => $this->header->is_tax));
        if ($headerValidate && $headerValidate->id != $this->header->id) {
            $valid = FALSE;
            $validOrdinal = FALSE;
        }
        else
            $valid = TRUE;

        $valid = $this->header->validate() && $valid;
        if (!$valid)
            $this->header->addError('error', 'Header Error');
        if (!$validOrdinal)
            $this->header->addError('ordinal', 'Number already exist');


        $valid = $valid && $this->validateDetailsCount();
        if (!$valid)
            $this->header->addError('error', 'Details Count error');


        return $valid;
    }

    public function flush() {
        $this->header->value = $this->getGrandTotal();
        $valid = $this->header->save(false);

        foreach ($this->details as $detail) {

            if ($detail->isNewRecord) {
                if ($detail->panel_name == NULL)
                    continue;
                $detail->sale_order_header_id = $this->header->id;
                $valid = $valid && $detail->save(false);
            }
            else {
                $valid = $valid && $detail->save(false);
            }
        }

        return $valid;
    }

    public function getSubTotal() {
        $total = 0;

        foreach ($this->details as $detail) {
            $total+= $detail->total;
        }

        return $total;
    }

    public function getDiscountValue() {
        return $this->subTotal * $this->header->discount / 100;
    }

    public function getPpn() {
        if ($this->header->is_tax == 1)
            return ($this->subTotal - $this->discountValue) * 0.1;
        else
            return 0;
    }

    public function getGrandTotal() {
        return $this->subTotal + $this->ppn - $this->discountValue;
    }

}
