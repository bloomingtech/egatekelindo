<?php

class EstimationComponentGroupController extends CrudController {

    public function actionCreate($id) {
        $estimationComponentGroup = $this->instantiate($id);
        $estimationHeader = EstimationHeader::model()->findByPk($estimationComponentGroup->header->estimationPanel->estimation_header_id);

        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
        $dataProvider = $component->search();

        if (isset($_POST['Save'])) {
            $this->loadState($estimationComponentGroup);
            if ($estimationComponentGroup->save(Yii::app()->db)) {
                $this->redirect(array('/transaction/estimation/viewPanelGroup', 'id' => $estimationComponentGroup->header->estimation_panel_id));
            }
        }

        $this->render('create', array(
            'estimationHeader' => $estimationHeader,
            'estimationComponentGroup' => $estimationComponentGroup,
            'component' => $component,
            'dataProvider' => $dataProvider
        ));
    }

    public function instantiate($id) {
        $componentGroup = $this->loadModel($id);
        $estimationComponentGroup = new EstimationComponentGroupComponent($componentGroup, $componentGroup->estimationComponents(array('order' => 'sort_number ASC')));
        return $estimationComponentGroup;
    }

    public function loadModel($id) {
        $model = EstimationComponentGroup::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadState($estimationComponentGroup) {
        // Load Header
        if (isset($_POST['EstimationComponentGroup'])) {
            $estimationComponentGroup->header->attributes = $_POST['EstimationComponentGroup'];
        }

        //load detail Component
        if (isset($_POST['EstimationComponent'])) {
            foreach ($_POST['EstimationComponent'] as $i => $item) {
                if (isset($estimationComponentGroup->detailComponents[$i]))
                    $estimationComponentGroup->detailComponents[$i]->attributes = $item;
                else {
                    $detail = new EstimationComponent();
                    $detail->attributes = $item;
                    $estimationComponentGroup->detailComponents[] = $detail;
                }
            }
            if (count($_POST['EstimationComponent']) < count($estimationComponentGroup->detailComponents))
                array_splice($estimationComponentGroup->detailComponents, $i + 1);
        }
        else
            $estimationComponentGroup->detailComponents = array();
    }

    public function actionAjaxHtmlAddComponentPanel($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $estimationComponentGroup = $this->instantiate($id);
            $this->loadState($estimationComponentGroup);

            if (isset($_POST['selectedIds'])) {
                $componentsId = array();
                $componentsId = $_POST['selectedIds'];

                foreach ($componentsId as $componentId) {
                    $estimationComponentGroup->addDetailComponent($componentId);
                }
            } else if (isset($_POST['ComponentId'])) {
                $estimationComponentGroup->addDetailComponent($_POST['ComponentId']);
            }

            $this->renderPartial('_addPanelComponent', array(
                'estimationComponentGroup' => $estimationComponentGroup,
            ));
        }
    }

    public function actionAjaxHtmlRemoveComponentPanel($id, $i) {
        if (Yii::app()->request->isAjaxRequest) {
            $estimationComponentGroup = $this->instantiate($id);
            $this->loadState($estimationComponentGroup);

            $estimationComponentGroup->removeComponentDetail($i);

            $this->renderPartial('_addPanelComponent', array(
                'estimationComponentGroup' => $estimationComponentGroup
            ));
        }
    }

    public function actionAjaxJsonTotalComponent($id, $i) {
        if (Yii::app()->request->isAjaxRequest) {
            $estimationComponentGroup = $this->instantiate($id);
            $this->loadState($estimationComponentGroup);

            $basicPrice = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimationComponentGroup->detailComponents[$i]->getBasicPrice($estimationComponentGroup->header->estimationPanel->estimationHeader->estimationBrandDiscounts)));

            $total = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimationComponentGroup->detailComponents[$i]->getTotal($estimationComponentGroup->header->estimationPanel->estimationHeader->estimationBrandDiscounts)));

            $subTotal = 0.00;
            foreach ($estimationComponentGroup->detailComponents as $detailComponent) {
                $subTotal+=$detailComponent->getTotal($estimationComponentGroup->header->estimationPanel->estimationHeader->estimationBrandDiscounts);
            }
            $subTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $subTotal));

            echo CJSON::encode(array(
                'total' => $total,
                'subTotal' => $subTotal,
                'basicPrice' => $basicPrice
            ));
        }
    }

    public function actionAjaxJsonAccesoriesValueComponent($id, $i) {
        if (Yii::app()->request->isAjaxRequest) {
            $estimationComponentGroup = $this->instantiate($id);
            $this->loadState($estimationComponentGroup);

            if ($estimationComponentGroup->detailComponents[$i]->accesories_phase_id == NULL)
                $value = 0;
            else
                $value = $estimationComponentGroup->detailComponents[$i]->accesoriesPhase->value;

            echo CJSON::encode(array(
                'value' => $value,
            ));
        }
    }

}

?>