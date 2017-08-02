<?php

class AccesoriesPhase extends AccesoriesPhaseBase
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
        
	public function getNameFull()
	{
//		$accesories1 = $this->accesories_id_1 ? $this->accesoriesId1->accesoriesAmpere->name : NULL; 
//		$accesories2 = $this->accesories_id_2 ? $this->accesoriesId2->accesoriesAmpere->name : NULL; 
//		$accesories3 = $this->accesories_id_3 ? $this->accesoriesId3->accesoriesAmpere->name : NULL; 
		
		if ($this->phase_number == 0)
			$accesoriesAmpere = $this->accesoriesId1->material->name;
		else
			$accesoriesAmpere = $this->accesoriesId1->accesoriesAmpere->name;


		return $this->name . ' | '. $accesoriesAmpere. ' | '. ($this->phase_number > 0 ? $this->phase_number . 'p | ' : '') .'  Rp. '. CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $this->value));
	}
        
        public function getPhaseNumberString()
        {
            return $this->phase_number > 0 ? $this->phase_number . 'p ' : '';
        }

	public function getValue()
	{
		if ($this->phase_number == 4 && $this->name == 'Box(3mm) < 800 A')
			$value = (($this->accesoriesId1->unit_price * 3 ) + ($this->accesoriesId2->unit_price * 6 ) + ($this->accesoriesId3->unit_price * 6 )) / 3 * 4;
		else if($this->phase_number == 4 && $this->name == 'Box(4.5mm) > 1000 A')
			$value = (($this->accesoriesId1->unit_price * 4.5 ) + ($this->accesoriesId2->unit_price * 6 ) + ($this->accesoriesId3->unit_price * 6 )) / 3 * 4;
		else if($this->phase_number == 4 && $this->name == 'Free Stand')
			$value = (($this->accesoriesId1->unit_price * 6 ) + ($this->accesoriesId2->unit_price * 6 ) + ($this->accesoriesId3->unit_price * 6 )) / 3 * 4;
		else if($this->phase_number == 3 && $this->name == 'Box(3mm) < 800 A')
			$value = (($this->accesoriesId1->unit_price * 3 ) + ($this->accesoriesId2->unit_price * 6 ) + ($this->accesoriesId3->unit_price * 6 ));
		else if($this->phase_number == 3 && $this->name == 'Box(4.5mm) > 1000 A')
			$value = (($this->accesoriesId1->unit_price * 4.5 ) + ($this->accesoriesId2->unit_price * 6 ) + ($this->accesoriesId3->unit_price * 6 ));
		else if($this->phase_number == 3 && $this->name == 'Free Stand')
			$value = (($this->accesoriesId1->unit_price * 6 ) + ($this->accesoriesId2->unit_price * 6 ) + ($this->accesoriesId3->unit_price * 6 ));
		else if($this->phase_number == 2 && $this->name == 'Box(3mm) < 800 A')
			$value = (($this->accesoriesId1->unit_price * 3 ) + ($this->accesoriesId2->unit_price * 6 ) + ($this->accesoriesId3->unit_price * 6 )) / 3 * 2;
		else if($this->phase_number == 2 && $this->name == 'Box(4.5mm) > 1000 A')
			$value = (($this->accesoriesId1->unit_price * 4.5 ) + ($this->accesoriesId2->unit_price * 6 ) + ($this->accesoriesId3->unit_price * 6 )) / 3 * 2;
		else if($this->phase_number == 2 && $this->name == 'Free Stand')
			$value = (($this->accesoriesId1->unit_price * 6 ) + ($this->accesoriesId2->unit_price * 6 ) + ($this->accesoriesId3->unit_price * 6 )) / 3 * 2;
		else if($this->phase_number == 1 && $this->name == 'Box(3mm) < 800 A')
			$value = (($this->accesoriesId1->unit_price * 3 ) + ($this->accesoriesId2->unit_price * 6 ) + ($this->accesoriesId3->unit_price * 6 )) / 3;
		else if($this->phase_number == 1 && $this->name == 'Box(4.5mm) > 1000 A')
			$value = (($this->accesoriesId1->unit_price * 4.5 ) + ($this->accesoriesId2->unit_price * 6 ) + ($this->accesoriesId3->unit_price * 6 )) / 3;
		else if($this->phase_number == 1 && $this->name == 'Free Stand')
			$value = (($this->accesoriesId1->unit_price * 6 ) + ($this->accesoriesId2->unit_price * 6 ) + ($this->accesoriesId3->unit_price * 6 )) / 3;
		else if($this->phase_number == 0)
			$value = $this->accesoriesId1->unit_price;

		return $value;

	}
}