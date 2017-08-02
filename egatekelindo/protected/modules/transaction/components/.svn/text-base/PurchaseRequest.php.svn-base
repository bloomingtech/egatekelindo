<?php

class PurchaseRequest extends CComponent {

    public $header;
    public $details;
	public $detailServices;

    public function __construct($header, array $details, array $detailServices) {
        $this->header = $header;
        $this->details = $details;
		$this->detailServices = $detailServices;
    }

    public function generateCodeNumber($currentMonth, $currentYear) {
        $purchaseRequestHeader = PurchaseRequestHeader::model()->find(array(
            'order' => 'id DESC',
		));

        if ($purchaseRequestHeader !== null)
            $this->header->setCodeNumber($purchaseRequestHeader->cn_ordinal, $purchaseRequestHeader->cn_month, $purchaseRequestHeader->cn_year);

        $this->header->setCodeNumberByNext($currentMonth, $currentYear);
    }

    public function addDetailProduct($id) {
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
                $detail = new PurchaseRequestDetailComponent();
                $detail->component_id = $component->id;
                $this->details[] = $detail;
            }
        }
    }

    public function addDetailService($id) {
        $component = Component::model()->findByPk($id);

        if ($component !== null) {

            $detail = new PurchaseRequestDetailService();
            $detail->component_id = $component->id;
            $detail->name = $component->name;
            $this->detailServices[] = $detail;

        }
    }

    public function removeDetailProductAt($index) {
        array_splice($this->details, $index, 1);
    }

    public function removeDetailServiceAt($index) {
        array_splice($this->detailServices, $index, 1);
    }

    public function validate() {
        $valid = $this->header->validate();
        if (!$valid)
            $this->header->addError('error', 'Header error');

//        $valid = $valid && $this->validateDetailsCount();
//		
//        if (!$valid)
//            $this->header->addError('error', 'Details Count error');
//
//        $valid = $valid && $this->validateDetailsUnique();
//		
//        if (!$valid)
//            $this->header->addError('error', 'Details Unique error');

		if ($this->header->is_service == 0) {
			if (count($this->details) > 0) {
				foreach ($this->details as $detail) {
					$fields = array('quantity', 'component_id');
					$valid = $valid && $detail->validate($fields);
				}
			}
			else
				$valid = false;
		} else {
		
			if (count($this->detailServices) > 0) {
				foreach ($this->detailServices as $detail) {
					$fields = array('quantity', 'component_id', 'name', 'weight');
					$valid = $valid && $detail->validate($fields);
				}
			}
			else
				$valid = false;
		}
		
        return $valid;
    }

    public function validateDetailsCount() {
        $valid = true;
		
		if ($this->header->is_service == 0) {
			if (count($this->details) === 0) {
				$valid = false;
				$this->header->addError('error', 'Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.');
			}
		} else {
			if (count($this->detailServices) === 0) {
				$valid = false;
				$this->header->addError('error', 'Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.');
			}
		}

        return $valid;
    }

    public function validateDetailsUnique() {
        $valid = true;

		if ($this->header->is_service == 0) {
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
		} else {
			$detailsCount = count($this->detailServices);
			for ($i = 0; $i < $detailsCount; $i++) {
				for ($j = $i; $j < $detailsCount; $j++) {
					if ($i === $j)
						continue;

					if ($this->detailServices[$i]->component_id === $this->detailServices[$j]->component_id) {
						$valid = false;
						$this->header->addError('error', 'Produk tidak boleh sama.');
						break;
					}
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
            $valid = false;
            $this->header->addError('error', $e->getMessage());
            $dbTransaction->rollback();
        }

        return $valid;
    }

    public function flush() {
        $valid = $this->header->save(false);

		if ($this->header->is_service == 0) {
			foreach ($this->details as $detail) {
//				if ($detail->quantity <= 0)
//					continue;

				if ($detail->isNewRecord) {
					$detail->purchase_request_header_id = $this->header->id;
					$valid = $valid && $detail->save(false);
				}
			}
		} else {
			foreach ($this->detailServices as $detail) {
//				if ($detail->quantity <= 0)
//					continue;

				if ($detail->isNewRecord) {
					$detail->purchase_request_header_id = $this->header->id;
					$valid = $valid && $detail->save(false);
				}
			}
		}

        return $valid;
    }

    public function delete($dbConnection) {
        $dbTransaction = $dbConnection->beginTransaction();
        try {
            $valid = true;

			if ($this->header->is_service == 0) {
				foreach ($this->details as $detail)
					$valid = $valid && $detail->delete();
			} else {
				foreach ($this->detailServices as $detail)
					$valid = $valid && $detail->delete();
			}

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
