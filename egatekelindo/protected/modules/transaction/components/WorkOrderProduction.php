<?php

class WorkOrderProduction extends CComponent {

    public $header;
    public $details;

    public function __construct($header, array $details) {
        $this->header = $header;
        $this->details = $details;
    }

    public function generateCodeNumber($currentMonth, $currentYear) {
        $workOrderProductionHeader = WorkOrderProductionHeader::model()->find(array(
            'order' => 'id DESC',
                ));

        if ($workOrderProductionHeader !== null)
            $this->header->setCodeNumber($workOrderProductionHeader->cn_ordinal, $workOrderProductionHeader->cn_month, $workOrderProductionHeader->cn_year);

        $this->header->setCodeNumberByNext($currentMonth, $currentYear);
    }

    public function addDetails($id) {
        $this->details = array();
        $workOrderDrawingHeader = WorkOrderDrawingHeader::model()->findByPk($id);
        $workOrderProductionHeaders = WorkOrderProductionHeader::model()->findAllByAttributes(array('work_order_drawing_header_id' => $id));

        if ($workOrderDrawingHeader) {
            foreach ($workOrderDrawingHeader->workOrderDrawingDetails as $workOrderDrawingDetail) {
                $exist = FALSE;
                foreach ($workOrderProductionHeaders as $workOrderProductionHeader) {
                    foreach ($workOrderProductionHeader->workOrderProductionDetails as $workOrderProductionDetail) {
                        if ($workOrderDrawingDetail->id == $workOrderProductionDetail->work_order_drawing_detail_id)
                            $exist = TRUE;
                    }
                }

                if (!$exist) {
                    $detail = new WorkOrderProductionDetail();
                    $detail->work_order_drawing_detail_id = $workOrderDrawingDetail->id;
					$detail->quantity = $workOrderDrawingDetail->saleOrderDetail->quantity;
                    $this->details[] = $detail;
                }
            }
        }
    }

    public function addDetail() {
        $detail = new DeliveryDetail();
        $this->details[] = $detail;
    }

    public function removeDetailAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function validate() {
        $validOrdinal = TRUE;
        $headerValidate = WorkOrderProductionHeader::model()->findByAttributes(array('cn_ordinal' => $this->header->cn_ordinal, 'cn_month' => $this->header->cn_month, 'cn_year' => $this->header->cn_year));
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

        if (count($this->details) > 0) {
            foreach ($this->details as $detail) {
//                if ($detail->delivery_date == NULL) {
//                    continue;
//                }
                $fields = array('quantity', 'panel_dimension', 'delivery_date');
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
                if ($detail->delivery_date == NULL) 
                    continue;
                
                $detail->work_order_production_header_id = $this->header->id;
                $valid = $valid && $detail->save(false);
            } else {
                if ((int) $detail->is_inactive === 1) {
                    $detail->delete();
//                    continue;
                } else if ($detail->delivery_date == NULL) {
                    continue;
                }
                else
                    $valid = $valid && $detail->save(false);
            }
        }

        return $valid;
    }

}
