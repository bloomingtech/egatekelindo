<?php

class PurchaseByRequirementController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionRequirementList() {
        $projectName = isset($_GET['ProjectName']) ? $_GET['ProjectName'] : '';
        $soOrdinal = isset($_GET['SoOrdinal']) ? $_GET['SoOrdinal'] : '';
        $soMonth = isset($_GET['SoMonth']) ? $_GET['SoMonth'] : '';
        $soYear = isset($_GET['SoYear']) ? $_GET['SoYear'] : '';

        $requirementHeader = Search::bind(new RequirementHeader('search'), isset($_GET['RequirementHeader']) ? $_GET['RequirementHeader'] : '');
        $requirementHeaderDataProvider = $requirementHeader->searchByPurchaseOrder();
        $requirementHeaderDataProvider->criteria->with = array(
            'saleOrderHeader'
        );

        if (!empty($projectName)) {
            $requirementHeaderDataProvider->criteria->addCondition('saleOrderHeader.project_name = :project_name');
            $requirementHeaderDataProvider->criteria->params[':project_name'] = $projectName;
            $requirementHeaderDataProvider->criteria->compare('saleOrderHeader.project_name', $projectName);
        }

        if (!empty($soOrdinal))
            $requirementHeaderDataProvider->criteria->compare('saleOrderHeader.cn_ordinal', $soOrdinal);

        if (!empty($soMonth))
            $requirementHeaderDataProvider->criteria->compare('saleOrderHeader.cn_month', $soMonth);

        if (!empty($soYear))
            $requirementHeaderDataProvider->criteria->compare('saleOrderHeader.cn_year', $soYear);

        $requirementHeaderDataProvider->criteria->order = 't.id DESC';

        $this->render('requirementList', array(
            'projectName' => $projectName,
            'soOrdinal' => $soOrdinal,
            'soMonth' => $soMonth,
            'soYear' => $soYear,
            'requirementHeader' => $requirementHeader,
            'requirementHeaderDataProvider' => $requirementHeaderDataProvider,
        ));
    }

    public function actionCreate($requirementId) {
        $requirementHeader = RequirementHeader::model()->findByPk($requirementId);

        $purchase = $this->instantiate(null);
        $purchase->header->admin_id = 1;
        $purchase->header->requirement_header_id = $requirementId;
        $purchase->header->sale_order_header_id = $requirementHeader->sale_order_header_id;
        $purchase->header->project_name = $requirementHeader->saleOrderHeader->project_name;
        $purchase->generateCodeNumber(date('m'), date('y'));
        $purchase->addDetails($requirementId);

        $supplier = Search::bind(new Supplier('search'), isset($_GET['Supplier']) ? $_GET['Supplier'] : array());
        $supplierDataProvider = $supplier->search();

        if (isset($_POST['Submit'])) {
            $this->loadState($purchase);

            if ($purchase->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $purchase->header->id));
        }

        $this->render('create', array(
            'purchase' => $purchase,
            'requirementHeader' => $requirementHeader,
            'supplier' => $supplier,
            'supplierDataProvider' => $supplierDataProvider,
        ));
    }

    public function actionUpdate($id) {
        $purchase = $this->instantiate($id);
        $requirementHeader = $purchase->header->requirementHeader;

        $supplier = Search::bind(new Supplier('search'), isset($_GET['Supplier']) ? $_GET['Supplier'] : array());
        $supplierDataProvider = $supplier->search();

        if (isset($_POST['Submit'])) {

            $this->loadState($purchase);
            if ($purchase->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $purchase->header->id));
            }
        }

        $this->render('update', array(
            'purchase' => $purchase,
            'requirementHeader' => $requirementHeader,
            'supplier' => $supplier,
            'supplierDataProvider' => $supplierDataProvider,
        ));
    }

    public function actionView($id) {
        $purchase = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('purchase_header_id', $purchase->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsDataProvider = new CActiveDataProvider('PurchaseDetailRequirement', array(
                    'criteria' => $criteria,
                ));

        $this->render('view', array(
            'purchase' => $purchase,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionMemo($id) {
        $purchase = $this->loadModel($id);

        $this->render('memo', array(
            'purchase' => $purchase,
        ));
    }

    public function actionAdmin() {
        $purchase = Search::bind(new PurchaseHeader('search'), isset($_GET['PurchaseHeader']) ? $_GET['PurchaseHeader'] : array());

        $dataProvider = $purchase->resetScope()->search();
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

        $dataProvider->criteria->condition = "t.is_purchase_request = 0";

        $this->render('admin', array(
            'purchase' => $purchase,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $model = $this->instantiate($id);

            if ($model->delete(Yii::app()->db))
                Yii::app()->user->setFlash('message', 'Delete Successful.');
            else
                Yii::app()->user->setFlash('message', 'Delete Failed.');

//            if (!isset($_GET['ajax']))
//                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionAjaxJsonSupplier($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $supplierId = (isset($_POST['PurchaseHeader']['supplier_id'])) ? $_POST['PurchaseHeader']['supplier_id'] : '';
            $supplier = Supplier::model()->findByPk($supplierId);

            $object = array(
                'supplier_name' => CHtml::value($supplier, 'name'),
                'supplier_company' => CHtml::value($supplier, 'company'),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxJsonTotal($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {

            $purchase = $this->instantiate($id);
            $this->loadState($purchase);

            $total = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($purchase->details[$index], 'totalAfterDiscount')));
            $totalQuantity = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->totalQuantity));
            $totalWeight = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->totalWeight));
            $subTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->subTotal));
            $taxValue = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->calculatedTax));
            $grandTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->grandTotal));

            echo CJSON::encode(array(
                'total' => $total,
                'totalQuantity' => $totalQuantity,
                'totalWeight' => $totalWeight,
                'subTotal' => $subTotal,
                'taxValue' => $taxValue,
                'grandTotal' => $grandTotal,
            ));
        }
    }

    public function actionAjaxJsonGrandTotal($id) {
        if (Yii::app()->request->isAjaxRequest) {

            $purchase = $this->instantiate($id);
            $this->loadState($purchase);

            $taxPercentage = CHtml::encode($purchase->taxPercentage);
            $taxValue = CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $purchase->calculatedTax));
            $grandTotal = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->grandTotal));

            echo CJSON::encode(array(
                'taxPercentage' => $taxPercentage,
                'taxValue' => $taxValue,
                'grandTotal' => $grandTotal,
            ));
        }
    }

    public function actionAjaxHtmlRemoveDetail($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $purchase = $this->instantiate($id);
            $this->loadState($purchase);

            $purchase->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'purchase' => $purchase,
            ));
        }
    }

    public function instantiate($id) {
        if (empty($id)) {
            $purchaseByRequirement = new PurchaseByRequirement(new PurchaseHeader(), array());
        } else {
            $purchaseHeader = $this->loadModel($id);
            $purchaseByRequirement = new PurchaseByRequirement($purchaseHeader, $purchaseHeader->purchaseDetailRequirements);
        }

        return $purchaseByRequirement;
    }

    public function loadModel($id) {
        $model = PurchaseHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadState($purchaseByRequirement) {
        if (isset($_POST['PurchaseHeader']))
            $purchaseByRequirement->header->attributes = $_POST['PurchaseHeader'];

        if (isset($_POST['PurchaseDetailRequirement'])) {
            foreach ($_POST['PurchaseDetailRequirement'] as $i => $item) {
                if (isset($purchaseByRequirement->details[$i]))
                    $purchaseByRequirement->details[$i]->attributes = $item;
                else {
                    $detail = new PurchaseDetailRequirement();
                    $detail->attributes = $item;
                    $purchaseByRequirement->details[] = $detail;
                }
            }
            if (count($_POST['PurchaseDetailRequirement']) < count($purchaseByRequirement->details))
                array_splice($purchaseByRequirement->details, $i + 1);
        }
        else
            $purchaseByRequirement->details = array();
    }

}
