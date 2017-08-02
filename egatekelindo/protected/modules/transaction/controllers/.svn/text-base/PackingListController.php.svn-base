<?php

class PackingListController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionCreate() {
        $packingList = $this->instantiate(null);
        $packingList->header->admin_id = 1;
        $packingList->generateCodeNumber(date('m'), date('y'));

        $partListHeader = Search::bind(new PartListHeader('search'), isset($_GET['PartListHeader']) ? $_GET['PartListHeader'] : array());
        $partListHeaderDataProvider = $partListHeader->searchByPackingList();

        if (isset($_POST['Submit'])) {
            $this->loadState($packingList);
            if ($packingList->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $packingList->header->id));
        }

        $this->render('create', array(
            'packingList' => $packingList,
            'partListHeader' => $partListHeader,
            'partListHeaderDataProvider' => $partListHeaderDataProvider,
        ));
    }

    public function actionUpdate($id) {
        $packingList = $this->instantiate($id);

        $partListHeader = Search::bind(new PartListHeader('search'), isset($_GET['PartListHeader']) ? $_GET['PartListHeader'] : array());
        $partListHeaderDataProvider = $partListHeader->searchByPackingList();

        if (isset($_POST['Submit'])) {
            $this->loadState($packingList);
            if ($packingList->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $packingList->header->id));
        }

        $this->render('update', array(
            'packingList' => $packingList,
            'partListHeader' => $partListHeader,
            'partListHeaderDataProvider' => $partListHeaderDataProvider,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $model = $this->instantiate($id);

            if ($model->delete(Yii::app()->db))
                Yii::app()->user->setFlash('message', 'Delete Successful.');
            else
                Yii::app()->user->setFlash('message', 'Delete Failed.');

//			if (!isset($_GET['ajax']))
//				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionView($id) {
        $packingList = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('packing_list_header_id', $packingList->id);
        $criteria->compare('t.is_inactive', 0);
        $detailsDataProvider = new CActiveDataProvider('PackingListDetail', array(
                    'criteria' => $criteria,
                ));

        $this->render('view', array(
            'packingList' => $packingList,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionMemo($id) {
        $packingList = $this->loadModel($id);

        $this->render('memo', array(
            'packingList' => $packingList,
        ));
    }

    public function actionAdmin() {
        $packingList = Search::bind(new PackingListHeader('search'), isset($_GET['PackingListHeader']) ? $_GET['PackingListHeader'] : array());

        $dataProvider = $packingList->resetScope()->search();
        $dataProvider->criteria->with = array(
            'partListHeader:resetScope'
        );

        $dataProvider->sort->attributes = array(
            'cn_ordinal' => 't.id',
            'date' => 't.date',
            'partListHeaderId' => 'partListHeader.id',
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
            'packingList' => $packingList,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAjaxHtmlRemoveDetail($index, $id) {
        if (Yii::app()->request->isAjaxRequest) {
            $packingList = $this->instantiate($id);

            $this->loadState($packingList);

            $packingList->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'packingList' => $packingList,
            ));
        }
    }

    public function actionAjaxJsonPartList($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $packingList = $this->instantiate($id);

            $this->loadState($packingList);

            $partListHeader = PartListHeader::model()->findByPk($_POST['PackingListHeader']['part_list_header_id']);

            $object = array(
                'part_list_header_code_number' => ($partListHeader === null) ? '' : $partListHeader->getCodeNumber(PartListHeader::CN_CONSTANT),
                'part_list_header_date' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($partListHeader, 'date')))),
            );

            echo CJSON::encode($object);
        }
    }

    public function actionAjaxHtmlShowPartList($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $packingList = $this->instantiate($id);

            $this->loadState($packingList);

            if (isset($_POST['PackingListHeader']['part_list_header_id']))
                $packingList->addDetailByPartList($_POST['PackingListHeader']['part_list_header_id']);

            $this->renderPartial('_detail', array(
                'packingList' => $packingList,
            ));
        }
    }

    public function instantiate($id) {
        if (empty($id))
            $packingList = new PackingList(new PackingListHeader(), array());
        else {
            $packingListHeader = $this->loadModel($id);
            $packingList = new PackingList($packingListHeader, $packingListHeader->packingListDetails);
        }

        return $packingList;
    }

    public function loadModel($id) {
        $model = PackingListHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function loadState(&$packingList) {
        if (isset($_POST['PackingListHeader'])) {
            $packingList->header->attributes = $_POST['PackingListHeader'];
        }
        if (isset($_POST['PackingListDetail'])) {
            foreach ($_POST['PackingListDetail'] as $i => $item) {
                if (isset($packingList->details[$i]))
                    $packingList->details[$i]->attributes = $item;
                else {
                    $detail = new PackingListDetail();
                    $detail->attributes = $item;
                    $packingList->details[] = $detail;
                }
            }
            if (count($_POST['PackingListDetail']) < count($packingList->details))
                array_splice($packingList->details, $i + 1);
        }
        else
            $packingList->details = array();
    }

}
