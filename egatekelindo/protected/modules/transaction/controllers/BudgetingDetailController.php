<?php

class BudgetingDetailController extends Controller {

    public function actionView($id, $headerId) {
        $budget = $this->loadModel($headerId);

        $criteria = new CDbCriteria;
        $criteria->compare('sale_order_detail_id', $id);
        $criteria->compare('is_inactive', 0);

        $saleOrderDetail = SaleOrderDetail::model()->findByPk($id);

        $detailDataProvider = new CActiveDataProvider('BudgetingDetail', array(
                    'criteria' => $criteria,
                    'pagination' => false
                ));

        $detailAccesoriesDataProvider = new CActiveDataProvider('BudgetingDetailAccesories', array(
                    'criteria' => $criteria,
                    'pagination' => false
                ));

        $this->render('view', array(
            'budget' => $budget,
            'detailDataProvider' => $detailDataProvider,
            'saleOrderDetail' => $saleOrderDetail,
            'detailAccesoriesDataProvider' => $detailAccesoriesDataProvider
        ));
    }

    public function actionUpdate($id, $headerId) {
        $budget = $this->loadModel($headerId);
        $budgetingDetail = $this->instantiate($id, $headerId);

        $saleOrderDetail = SaleOrderDetail::model()->findByPk($id);

        $criteria = new CDbCriteria;
        $criteria->compare('sale_order_detail_id', $id);

        $detailDataProvider = new CActiveDataProvider('BudgetingDetail', array(
                    'criteria' => $criteria,
                    'pagination' => false
                ));

        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
        $dataProvider = $component->search();

        if (isset($_POST['Save'])) {
            $this->loadStateDetail($budgetingDetail);
            if ($budgetingDetail->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $id, 'headerId' => $headerId));
            }
        }

        $this->render('update', array(
            'budget' => $budget,
            'detailDataProvider' => $detailDataProvider,
            'budgetingDetail' => $budgetingDetail,
            'component' => $component,
            'dataProvider' => $dataProvider,
            'saleOrderDetail' => $saleOrderDetail
        ));
    }

    public function instantiate($saleOrderDetailId, $id) {
        if (empty($id))
            $budgetingDetail = new BudgetingDetailComponent(new BudgetingHeader(), array(), array());
        else {
            $budgetingHeader = $this->loadModel($id);

            $budgetingDetails = array();
            foreach ($budgetingHeader->budgetingDetails as $budgetingDetail)
                if ($budgetingDetail->sale_order_detail_id == $saleOrderDetailId)
                    $budgetingDetails[] = $budgetingDetail;

            $budgetingDetailAccesories = array();
            foreach ($budgetingHeader->budgetingDetailAccesories as $budgetingDetailAccesory)
                if ($budgetingDetailAccesory->sale_order_detail_id == $saleOrderDetailId)
                    $budgetingDetailAccesories[] = $budgetingDetailAccesory;


            $budgetingDetail = new BudgetingDetailComponent($budgetingHeader, $budgetingDetails, $budgetingDetailAccesories);
        }
        return $budgetingDetail;
    }

    public function loadModelDetail($id) {
        $model = BudgetingDetail::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModel($id) {
        $model = BudgetingHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadStateDetail($budgetingDetail) {

        //load detail RequirementDetailComponent
        if (isset($_POST['BudgetingDetail'])) {
            foreach ($_POST['BudgetingDetail'] as $i => $item) {
                if (isset($budgetingDetail->detailComponents[$i]))
                    $budgetingDetail->detailComponents[$i]->attributes = $item;
                else {
                    $detail = new BudgetingDetail();
                    $detail->attributes = $item;
                    $budgetingDetail->detailComponents[] = $detail;
                }
            }
            if (count($_POST['BudgetingDetail']) < count($budgetingDetail->detailComponents))
                array_splice($budgetingDetail->detailComponents, $i + 1);
        }
        else
            $budgetingDetail->detailComponents = array();

        if (isset($_POST['BudgetingDetailAccesories'])) {
            foreach ($_POST['BudgetingDetailAccesories'] as $i => $item) {
                if (isset($budgetingDetail->detailAccesories[$i]))
                    $budgetingDetail->detailAccesories[$i]->attributes = $item;
                else {
                    $detail = new BudgetingDetailAccesories();
                    $detail->attributes = $item;
                    $budgetingDetail->detailAccesories[] = $detail;
                }
            }
            if (count($_POST['BudgetingDetailAccesories']) < count($budgetingDetail->detailAccesories))
                array_splice($budgetingDetail->detailAccesories, $i + 1);
        }
        else
            $budgetingDetail->detailAccesories = array();
    }

    public function actionAjaxHtmlAddComponentDetail($id, $saleOrderDetailId) {
        if (Yii::app()->request->isAjaxRequest) {
            $budgetingDetail = $this->instantiate($saleOrderDetailId, $id);
            $this->loadStateDetail($budgetingDetail);
            $saleOrderDetail = SaleOrderDetail::model()->findByPk($saleOrderDetailId);

            if (isset($_POST['selectedIds'])) {
                $componentsId = array();
                $componentsId = $_POST['selectedIds'];

                foreach ($componentsId as $componentId) {
                    $budgetingDetail->addDetailComponent($componentId, $saleOrderDetailId, $id);
                }
            } else if (isset($_POST['ComponentId'])) {
                $budgetingDetail->addDetailComponent($_POST['ComponentId'], $saleOrderDetailId, $id);
            }

            $this->renderPartial('_detail', array(
                'budgetingDetail' => $budgetingDetail,
                'saleOrderDetail' => $saleOrderDetail
            ));
        }
    }

    public function actionAjaxHtmlAddComponentDetailAccesories($id, $saleOrderDetailId) {
        if (Yii::app()->request->isAjaxRequest) {
            $budgetingDetail = $this->instantiate($saleOrderDetailId, $id);
            $this->loadStateDetail($budgetingDetail);
            $saleOrderDetail = SaleOrderDetail::model()->findByPk($saleOrderDetailId);

            if (isset($_POST['selectedIdsAccesories'])) {
                $componentsId = array();
                $componentsId = $_POST['selectedIdsAccesories'];

                foreach ($componentsId as $componentId) {
                    $budgetingDetail->addDetailComponentAccesories($componentId, $saleOrderDetailId, $id);
                }
            } else if (isset($_POST['ComponentIdAccesories'])) {
                $budgetingDetail->addDetailComponentAccesories($_POST['ComponentIdAccesories'], $saleOrderDetailId, $id);
            }

            $this->renderPartial('_detail_accesories', array(
                'budgetingDetail' => $budgetingDetail,
                'saleOrderDetail' => $saleOrderDetail
            ));
        }
    }

    public function actionAjaxHtmlRemoveDetail($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $budgetingDetail = $this->instantiate($id);

            $this->loadStateDetail($budgetingDetail);

            $budgetingDetail->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'budgetingDetail' => $budgetingDetail,
            ));
        }
    }

    public function actionAjaxJsonTotal($id, $index, $saleOrderDetailId) {
        if (Yii::app()->request->isAjaxRequest) {
            $budgetingDetail = $this->instantiate($saleOrderDetailId, $id);
            $this->loadStateDetail($budgetingDetail);

            $object = array(
                'total' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($budgetingDetail->detailComponents[$index], 'total'))),
                'subTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $budgetingDetail->getSubTotal($saleOrderDetailId))),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxJsonTotalAccesories($id, $index, $saleOrderDetailId) {
        if (Yii::app()->request->isAjaxRequest) {
            $budgetingDetail = $this->instantiate($saleOrderDetailId, $id);
            $this->loadStateDetail($budgetingDetail);

            $object = array(
                'total' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($budgetingDetail->detailAccesories[$index], 'total'))),
                'subTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $budgetingDetail->getTotalAccesories($saleOrderDetailId))),
            );

            echo CJSON::encode($object);
        }
    }

}
