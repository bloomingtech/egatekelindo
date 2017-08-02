<?php

class EstimationPanel extends EstimationPanelBase {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getSubTotal() {
        $total = 0.00;

        foreach ($this->estimationComponents(array(
			'condition' => 'estimationComponents.is_inactive = 0'
		)) as $estimationComponent)
			$total += $estimationComponent->totalOnly;

        return $total;
    }

    public function getSubTotalAccesories() {
        $total = 0.00;

        foreach ($this->estimationComponentAccesories(array(
            'condition' => 'estimationComponentAccesories.is_inactive = 0'
        )) as $estimationComponentAccesories)
            $total += $estimationComponentAccesories->totalOnly;

        return $total;
    }

    public function getSubTotalCu() {
        $totalCu = 0;

        foreach ($this->estimationComponentAccesories as $estimationComponentAccesory) {
            if ($estimationComponentAccesory->component_cu_id != NULL)
                $totalCu += $estimationComponentAccesory->getTotalOnly();
        }
        return $totalCu;
    }

    public function getSubTotalAccesoriesPhase() {
        $totalAccesoriesPhase = 0;

        foreach ($this->estimationComponents as $estimationComponent) {
            if ($estimationComponent->accesories_phase_value > 0)
                $totalAccesoriesPhase += $estimationComponent->accesories_phase_value * $estimationComponent->quantity;
        }

        foreach ($this->estimationComponentAccesories as $estimationComponentAccesory) {
            if ($estimationComponentAccesory->accesories_phase_value > 0)
                $totalAccesoriesPhase += $estimationComponentAccesory->accesories_phase_value * $estimationComponentAccesory->quantity;
        }

        return $totalAccesoriesPhase * $this->estimationHeader->mark_up_accesories;
    }

    public function getSubtotalWiring() {
        $totalWiring = 0;
        $totalWiring = $this->getSubTotal() + $this->getSubTotalAccesories() + $this->getSubTotalCu() + $this->getSubTotalAccesoriesPhase();

        if ($totalWiring < $this->estimationHeader->mark_up_wiring_border)
            return $totalWiring * $this->estimationHeader->mark_up_wiring_low;
        else
            return $totalWiring * $this->estimationHeader->mark_up_wiring_high;
    }

    public function getGrandTotal() {
        return $this->getSubTotal() + $this->getSubTotalAccesories() + $this->getSubTotalCu() + $this->getSubTotalAccesoriesPhase() + $this->getSubtotalWiring();
    }

}