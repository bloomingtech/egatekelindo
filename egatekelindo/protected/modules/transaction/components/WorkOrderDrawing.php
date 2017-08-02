<?php

class WorkOrderDrawing extends CComponent {

    public $header;
    public $details;

    public function __construct($header, array $details) {
        $this->header = $header;
        $this->details = $details;
    }

    public function generateCodeNumber($currentMonth, $currentYear) {
        $workOrderDrawingHeader = WorkOrderDrawingHeader::model()->find(array(
            'order' => 'id DESC',
                ));

        if ($workOrderDrawingHeader !== null)
            $this->header->setCodeNumber($workOrderDrawingHeader->cn_ordinal, $workOrderDrawingHeader->cn_month, $workOrderDrawingHeader->cn_year);

        $this->header->setCodeNumberByNext($currentMonth, $currentYear);
    }

    public function addDetails($id) {
        $this->details = array();
        $budgetingHeader = BudgetingHeader::model()->findByPk($id);
        $workOrderDrawingHeaders = WorkOrderDrawingHeader::model()->findAllByAttributes(array('budgeting_header_id' => $id));


        if ($budgetingHeader) {

            $saleOrderHeader = SaleOrderHeader::model()->findByPk($budgetingHeader->sale_order_header_id);

            if ($saleOrderHeader) {
                foreach ($saleOrderHeader->saleOrderDetails as $saleOrderDetail) {
                    if ($saleOrderDetail->is_inactive == 0) {
                        $exist = FALSE;
                        foreach ($workOrderDrawingHeaders as $workOrderDrawingHeader) {
                            foreach ($workOrderDrawingHeader->workOrderDrawingDetails as $workOrderDrawingDetail) {
                                if ($saleOrderDetail->id == $workOrderDrawingDetail->sale_order_detail_id)
                                    $exist = TRUE;
                            }
                        }

                        if (!$exist) {
                            $detail = new WorkOrderDrawingDetail();
                            $detail->sale_order_detail_id = $saleOrderDetail->id;
                            $this->details[] = $detail;
                        }
                    }
                }
            }
        }
    }

    public function removeDetailAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function validate() {
        $validOrdinal = TRUE;
        $headerValidate = WorkOrderDrawingHeader::model()->findByAttributes(array('cn_ordinal' => $this->header->cn_ordinal, 'cn_month' => $this->header->cn_month, 'cn_year' => $this->header->cn_year));
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

//        if (count($this->details) > 0) {
//            foreach ($this->details as $detail) {
//                $fields = array('finish_date');
//                $valid = $valid && $detail->validate($fields);
//            }
//        }
//        else
//            $valid = false;

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

            if ($detail->isNewRecord) {
                if ($detail->finish_date == NULL) {
                    continue;
                }
                $detail->work_order_drawing_header_id = $this->header->id;
                $valid = $valid && $detail->save(false);
            } else {
                if ((int) $detail->is_inactive === 1) {
                    $detail->delete();
                    continue;
                } else if ($detail->finish_date == NULL) {
                    continue;
                }
                else
                    $valid = $valid && $detail->save(false);
            }
        }

        return $valid;
    }

}
