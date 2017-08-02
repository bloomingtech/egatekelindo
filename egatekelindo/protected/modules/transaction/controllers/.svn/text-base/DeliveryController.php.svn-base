<?php

class DeliveryController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionCreate() {
        $delivery = $this->instantiate(null);
        $delivery->header->admin_id = 1;
        $delivery->generateCodeNumber(date('m'), date('y'));

        $saleOrder = Search::bind(new SaleOrderHeader('search'), isset($_GET['SaleOrderHeader']) ? $_GET['SaleOrderHeader'] : array());
        $saleOrderDataProvider = $saleOrder->searchByDelivery();

        if (isset($_POST['Submit'])) {
            $this->loadState($delivery);
            if ($delivery->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $delivery->header->id));
        }

        $this->render('create', array(
            'delivery' => $delivery,
            'saleOrder' => $saleOrder,
            'saleOrderDataProvider' => $saleOrderDataProvider,
        ));
    }

    public function actionUpdate($id) {
        $delivery = $this->instantiate($id);

        $saleOrder = Search::bind(new SaleOrderHeader('search'), isset($_GET['SaleOrderHeader']) ? $_GET['SaleOrderHeader'] : array());
        $saleOrderDataProvider = $saleOrder->searchByDelivery();

        if (isset($_POST['Submit'])) {
            $this->loadState($delivery);
            if ($delivery->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $delivery->header->id));
        }

        $this->render('update', array(
            'delivery' => $delivery,
            'saleOrder' => $saleOrder,
            'saleOrderDataProvider' => $saleOrderDataProvider,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $model = $this->instantiate($id);

            if ($model->delete(Yii::app()->db))
                Yii::app()->user->setFlash('message', 'Delete Successful.');
            else
                Yii::app()->user->setFlash('message', 'Delete Failed.');
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionView($id) {
        $delivery = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('delivery_header_id', $delivery->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsDataProvider = new CActiveDataProvider('DeliveryDetail', array(
                    'criteria' => $criteria,
                ));

        $this->render('view', array(
            'delivery' => $delivery,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionMemo($id) {
        $delivery = $this->loadModel($id);

        $this->render('memo', array(
            'delivery' => $delivery,
        ));
    }

    public function actionAdmin() {
        $delivery = Search::bind(new DeliveryHeader('search'), isset($_GET['DeliveryHeader']) ? $_GET['DeliveryHeader'] : array());

        $dataProvider = $delivery->resetScope()->search();
        $dataProvider->criteria->with = array(
            'saleOrder:resetScope'
        );

        $dataProvider->sort->attributes = array(
            'cn_ordinal' => 't.id',
            'date' => 't.date',
            'saleOrderId' => 'saleOrder.id',
            'note' => 't.note'
        );

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';

        if ($startDate != '' || $endDate != '') {
            $startDate = (empty($startDate)) ? date('Y-m-d') : $startDate;
            $endDate = (empty($endDate)) ? date('Y-m-d') : $endDate;

            $dataProvider->criteria->addBetweenCondition('t.date', $startDate, $endDate);
        }

        $this->render('admin', array(
            'delivery' => $delivery,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAjaxHtmlRemoveDetail($index, $id) {
        if (Yii::app()->request->isAjaxRequest) {
            $delivery = $this->instantiate($id);

            $this->loadState($delivery);

            $delivery->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'delivery' => $delivery,
            ));
        }
    }

    public function actionAjaxHtmlAddDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $delivery = $this->instantiate($id);
            $this->loadState($delivery);

            $delivery->addDetail();

            $this->renderPartial('_detail', array(
                'delivery' => $delivery,
            ));
        }
    }

    public function actionAjaxJsonSale($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $delivery = $this->instantiate($id);

            $this->loadState($delivery);

            $saleOrder = SaleOrderHeader::model()->findByPk($_POST['DeliveryHeader']['sale_order_header_id']);

            $object = array(
                'sale_order_code_number' => ($saleOrder === null) ? '' : $saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT),
                'sale_order_date' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($saleOrder, 'date')))),
            );

            echo CJSON::encode($object);
        }
    }

    public function instantiate($id) {
        if (empty($id))
            $delivery = new Delivery(new DeliveryHeader(), array());
        else {
            $deliveryHeader = $this->loadModel($id);
            $delivery = new Delivery($deliveryHeader, $deliveryHeader->deliveryDetails);
        }

        return $delivery;
    }

    public function loadModel($id) {
        $model = DeliveryHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function loadState(&$delivery) {
        if (isset($_POST['DeliveryHeader'])) {
            $delivery->header->attributes = $_POST['DeliveryHeader'];
        }
        if (isset($_POST['DeliveryDetail'])) {
            foreach ($_POST['DeliveryDetail'] as $i => $item) {
                if (isset($delivery->details[$i]))
                    $delivery->details[$i]->attributes = $item;
                else {
                    $detail = new DeliveryDetail();
                    $detail->attributes = $item;
                    $delivery->details[] = $detail;
                }
            }
            if (count($_POST['DeliveryDetail']) < count($delivery->details))
                array_splice($delivery->details, $i + 1);
        }
        else
            $delivery->details = array();
    }

}
