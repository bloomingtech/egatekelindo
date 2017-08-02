<?php

class SaleReturnController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionCreate() {
        $saleReturn = $this->instantiate(null);
        $saleReturn->generateCodeNumber(date('m'), date('y'));
        $saleReturn->header->admin_id = 1;

        $saleOrder = Search::bind(new SaleOrderHeader('search'), isset($_GET['SaleOrderHeader']) ? $_GET['SaleOrderHeader'] : array());
        $saleOrderDataProvider = $saleOrder->searchBySaleReturn();

        if (isset($_POST['Submit'])) {
            $this->loadState($saleReturn);
            if ($saleReturn->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $saleReturn->header->id));
        }

        $this->render('create', array(
            'saleReturn' => $saleReturn,
            'saleOrder' => $saleOrder,
            'saleOrderDataProvider' => $saleOrderDataProvider
        ));
    }

    public function actionUpdate($id) {
        $saleReturn = $this->instantiate($id);

        if (isset($_POST['Submit'])) {
            $this->loadState($saleReturn);
            if ($saleReturn->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $saleReturn->header->id));
        }

        $this->render('update', array(
            'saleReturn' => $saleReturn,
        ));
    }

    public function actionView($id) {
        $saleReturn = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('sale_return_header_id', $saleReturn->id);
        $criteria->compare('t.is_inactive', 0);

        $detailsDataProvider = new CActiveDataProvider('SaleReturnDetail', array(
                    'criteria' => $criteria,
                ));


        $this->render('view', array(
            'saleReturn' => $saleReturn,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionMemo($id) {
        $this->render('memo', array(
            'saleReturn' => $this->loadModel($id)
        ));
    }

    public function actionAdmin() {
        $saleReturnHeader = Search::bind(new SaleReturnHeader('search'), isset($_GET['SaleReturnHeader']) ? $_GET['SaleReturnHeader'] : array());

        $dataProvider = $saleReturnHeader->resetScope()->search();

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';

        if ($startDate != '' || $endDate != '') {
            $startDate = (empty($startDate)) ? date('Y-m-d') : $startDate;
            $endDate = (empty($endDate)) ? date('Y-m-d') : $endDate;
            $dataProvider->criteria->addBetweenCondition('t.date', $startDate, $endDate);
        }

        $dataProvider->sort->attributes = array(
            'cn_ordinal' => 't.id',
            'date' => 't.date',
        );

        $dataProvider->criteria->order = 't.id DESC';

        $this->render('admin', array(
            'saleReturnHeader' => $saleReturnHeader,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAjaxHtmlAddDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $saleReturn = $this->instantiate($id);
            $this->loadState($saleReturn);

            $saleReturn->addDetail();

            $this->renderPartial('_detail', array(
                'saleReturn' => $saleReturn,
            ));
        }
    }

    public function actionAjaxHtmlRemoveDetail($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $saleReturn = $this->instantiate($id);
            $this->loadState($saleReturn);

            $saleReturn->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'saleReturn' => $saleReturn,
            ));
        }
    }

    public function actionAjaxJsonTotal($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $saleReturn = $this->instantiate($id);
            $this->loadState($saleReturn);

            $object = array(
                'total' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleReturn->details[$index], 'total'))),
                'subTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $saleReturn->getSubTotal())),
                'taxTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $saleReturn->getTaxTotal())),
                'grandTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $saleReturn->getGrandTotal())),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxJsonTotalByDiscount($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $saleReturn = $this->instantiate($id);
            $this->loadState($saleReturn);

            $object = array(
                'grandTotal' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $saleReturn->getGrandTotal())),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxJsonSaleOrder($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $saleReturn = $this->instantiate($id);

            $this->loadState($saleReturn);

            $saleOrder = SaleOrderHeader::model()->findByPk($_POST['SaleReturnHeader']['sale_order_header_id']);

            $object = array(
                'sale_order_code_number' => ($saleOrder === null) ? '' : $saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT),
                'sale_order_date' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($saleOrder, 'date')))),
                'sale_order_work_order_number' => CHtml::encode(CHtml::value($saleOrder, 'work_order_number')),
                'sale_order_project_name' => CHtml::encode(CHtml::value($saleOrder, 'project_name')),
            );

            echo CJSON::encode($object);
        }
    }

    public function instantiate($id) {
        if (empty($id)) {
            $saleReturn = new SaleReturnComponent(new SaleReturnHeader, array());
        } else {
            $saleReturnHeader = $this->loadModel($id);
            $saleReturn = new SaleReturnComponent($saleReturnHeader, $saleReturnHeader->saleReturnDetails);
        }

        return $saleReturn;
    }

    public function loadModel($id) {
        $model = SaleReturnHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadState($saleReturn) {
        if (isset($_POST['SaleReturnHeader'])) {
            $saleReturn->header->attributes = $_POST['SaleReturnHeader'];
        }
        if (isset($_POST['SaleReturnDetail'])) {
            foreach ($_POST['SaleReturnDetail'] as $i => $item) {
                if (isset($saleReturn->details[$i]))
                    $saleReturn->details[$i]->attributes = $item;
                else {
                    $detail = new SaleReturnDetail();
                    $detail->attributes = $item;
                    $saleReturn->details[] = $detail;
                }
            }
            if (count($_POST['SaleReturnDetail']) < count($saleReturn->details))
                array_splice($saleReturn->details, $i + 1);
        }
        else
            $saleReturn->details = array();
    }

}

?>
