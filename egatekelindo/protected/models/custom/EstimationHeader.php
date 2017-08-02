<?php

class EstimationHeader extends EstimationHeaderBase {
    const CN_CONSTANT = 'EST';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

	public function getTotalComponent()
	{
		$total = 0.00;

        if ($this->estimationPanels != null) {
            foreach ($this->estimationPanels as $estimationPanel) {
                $total += $estimationPanel->subTotal;
            }
        }
        return $total;		
	}
	
    public function getSubTotal() {
        $total = 0.00;

        if ($this->estimationPanels != null) {
            foreach ($this->estimationPanels as $estimationPanel) {
                $total += $estimationPanel->grandTotal;
            }
        }
        return $total;
    }

    public function getSubTotalComponent($estimationPanelId) {
        $total = 0.00;

        $estimationPanel = EstimationPanel::model()->findByPk($estimationPanelId);

        foreach ($estimationPanel->estimationComponents as $detail)
            $total += $detail->totalOnly;

        return $total;
    }

    public function getSubTotalComponentEachGroup($estimationPanelId, $componentGroupId) {
        $total = 0.00;

        $estimationPanel = EstimationPanel::model()->findByPk($estimationPanelId);

        foreach ($estimationPanel->estimationComponents as $detail)
            if ($detail->component->component_group_id == $componentGroupId)
                $total += $detail->totalOnly;

        return $total;
    }

    public function getTotalAccesories($estimationPanelId) {
        $total = 0.00;
        $estimationPanel = EstimationPanel::model()->findByPk($estimationPanelId);

        foreach ($estimationPanel->estimationComponentAccesories as $detail)
            $total += $detail->totalOnly;

        return $total;
    }

    public function getSubTotalEachPanel($index, $detailComponents, $estimation) {
        $total = 0.00;
//        $estimationCurrent = isset(Yii::app()->session['estimation']) ? Yii::app()->session['estimation'] : array();
//        $estimationPanel = $estimationCurrent->panels[$index];
//
//        $estimationComponents = Yii::app()->session['SessionList'];
//
//        foreach ($estimationPanel->estimationComponents as $estimationComponent) {
//            $total += $estimationComponent->getTotal($brandDiscounts);
//        }
//        

        if ($detailComponents)
            foreach ($detailComponents as $i => $detail) {
                if ($detail->estimation_panel_id == $index)
                    $total+= $detail->getTotal($estimation->details);
            }

        return $total;
    }

    public function getSubTotalAccesoriesEachPanel($index, $detailAccesories, $estimation) {
        $total = 0.00;
        if ($detailAccesories)
            foreach ($detailAccesories as $i => $detail) {
                if ($detail->estimation_panel_id == $index)
                    $total+= $detail->getTotal($estimation->details);
            }

        return $total;
    }

    public function getAllReviseDate() {
        $date = '';

        $estimationHeaderRevises = EstimationHeaderRevise::model()->findAllByAttributes(array('estimation_header_id' => $this->id));

        if ($estimationHeaderRevises)
            foreach ($estimationHeaderRevises as $estimationHeaderRevise) {
                $date.= Yii::app()->dateFormatter->format("d MMMM yyyy", $estimationHeaderRevise->date) . ' | ';
            }

        return $date;
    }

}