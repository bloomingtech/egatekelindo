<?php

class RequirementDetailController extends Controller {

    public function actionView($id, $headerId) {
        $requirement = $this->loadModel($headerId);

        $criteria = new CDbCriteria;
        $criteria->compare('requirement_detail_id', $id);
        $criteria->compare('is_inactive', 0);

        $requirementDetail = RequirementDetail::model()->findByPk($id);

        $detailDataProvider = new CActiveDataProvider('RequirementDetailComponent', array(
			'criteria' => $criteria,
			'pagination' => false
		));
        
        $detailAdditionalDataProvider = new CActiveDataProvider('RequirementDetailAdditional', array(
			'criteria' => $criteria,
			'pagination' => false
		));

        $this->render('view', array(
            'requirement' => $requirement,
            'detailDataProvider' => $detailDataProvider,
            'requirementDetail' => $requirementDetail,
            'detailAdditionalDataProvider' => $detailAdditionalDataProvider
        ));
    }

    public function actionUpdate($id, $headerId) {
        $requirement = $this->loadModel($headerId);
        $requirementDetail = $this->instantiate($id);

        $criteria = new CDbCriteria;
        $criteria->compare('requirement_detail_id', $id);

        $detailDataProvider = new CActiveDataProvider('RequirementDetailComponent', array(
			'criteria' => $criteria,
			'pagination' => false
		));

        $component = Search::bind(new Component('search'), isset($_GET['Component']) ? $_GET['Component'] : array());
        $dataProvider = $component->search();

        $componentCu = Search::bind(new ComponentCu('search'), isset($_GET['ComponentCu']) ? $_GET['ComponentCu'] : array());
        $cuDataProvider = $componentCu->search();

        if (isset($_POST['Save'])) {
            $this->loadStateDetail($requirementDetail);
            if ($requirementDetail->save(Yii::app()->db)) {
                $this->redirect(array('view', 'id' => $id, 'headerId' => $headerId));
            }
        }

        $this->render('update', array(
            'requirement' => $requirement,
            'detailDataProvider' => $detailDataProvider,
            'requirementDetail' => $requirementDetail,
            'component' => $component,
            'dataProvider' => $dataProvider,
            'componentCu' => $componentCu,
            'cuDataProvider' => $cuDataProvider
        ));
    }

    public function instantiate($id) {
        if (empty($id))
            $requirementDetail = new RequirementDetailPanelComponent(new RequirementDetail(), array(), array());
        else {
            $requirementPanel = $this->loadModelDetail($id);
            $requirementDetails = RequirementDetailComponent::model()->findAllByAttributes(array('requirement_detail_id' => $id));
            $requirementDetailAdditionals = RequirementDetailAdditional::model()->findAllByAttributes(array('requirement_detail_id' => $id));
            $requirementDetail = new RequirementDetailPanelComponent($requirementPanel, $requirementDetails ? $requirementDetails : array(), $requirementDetailAdditionals ? $requirementDetailAdditionals : array());
        }
        return $requirementDetail;
    }

    public function loadModelDetail($id) {
        $model = RequirementDetail::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModel($id) {
        $model = RequirementHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadStateDetail($requirementDetail) {

        //load detail RequirementDetailComponent
        if (isset($_POST['RequirementDetailComponent'])) {
            foreach ($_POST['RequirementDetailComponent'] as $i => $item) {
                if (isset($requirementDetail->detailComponents[$i]))
                    $requirementDetail->detailComponents[$i]->attributes = $item;
                else {
                    $detail = new RequirementDetailComponent();
                    $detail->attributes = $item;
                    $requirementDetail->detailComponents[] = $detail;
                }
            }
            if (count($_POST['RequirementDetailComponent']) < count($requirementDetail->detailComponents))
                array_splice($requirementDetail->detailComponents, $i + 1);
        }
        else
            $requirementDetail->detailComponents = array();
        
        
        //load detail RequirementDetailComponent
        if (isset($_POST['RequirementDetailAdditional'])) {
            foreach ($_POST['RequirementDetailAdditional'] as $i => $item) {
                if (isset($requirementDetail->detailAdditionals[$i]))
                    $requirementDetail->detailAdditionals[$i]->attributes = $item;
                else {
                    $detail = new RequirementDetailAdditional();
                    $detail->attributes = $item;
                    $requirementDetail->detailAdditionals[] = $detail;
                }
            }
            if (count($_POST['RequirementDetailAdditional']) < count($requirementDetail->detailAdditionals))
                array_splice($requirementDetail->detailAdditionals, $i + 1);
        }
        else
            $requirementDetail->detailAdditionals = array();
    }

    public function actionAjaxHtmlAddComponentDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $requirementDetail = $this->instantiate($id);
            $this->loadStateDetail($requirementDetail);

            if (isset($_POST['selectedIds'])) {
                $componentsId = array();
                $componentsId = $_POST['selectedIds'];

                foreach ($componentsId as $componentId) {
                    $requirementDetail->addDetailComponent($componentId, $id);
                }
            } else if (isset($_POST['ComponentId'])) {
                $requirementDetail->addDetailComponent($_POST['ComponentId'], $id);
            }

            $this->renderPartial('_detail', array(
                'requirementDetail' => $requirementDetail,
            ));
        }
    }
    
     public function actionAjaxHtmlAddComponentAdditionalDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $requirementDetail = $this->instantiate($id);
            $this->loadStateDetail($requirementDetail);

            if (isset($_POST['selectedAdditionalIds'])) {
                $componentsId = array();
                $componentsId = $_POST['selectedAdditionalIds'];

                foreach ($componentsId as $componentId) {
                    $requirementDetail->addDetailComponentAdditional($componentId, $id);
                }
            } else if (isset($_POST['ComponentAdditionalId'])) {
                $requirementDetail->addDetailComponentAdditional($_POST['ComponentAdditionalId'], $id);
            }

            $this->renderPartial('_detail_additional', array(
                'requirementDetail' => $requirementDetail,
            ));
        }
    }

    public function actionAjaxHtmlAddComponentCuDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $requirementDetail = $this->instantiate($id);
            $this->loadStateDetail($requirementDetail);

            if (isset($_POST['selectedCuIds'])) {
                $componentsCuId = array();
                $componentsCuId = $_POST['selectedCuIds'];

                foreach ($componentsCuId as $componentCuId) {
                    $requirementDetail->addDetailComponentCu($componentCuId, $id);
                }
            } else if (isset($_POST['ComponentCuId'])) {
                $requirementDetail->addDetailComponentCu($_POST['ComponentCuId'], $id);
            }

            $this->renderPartial('_detail', array(
                'requirementDetail' => $requirementDetail,
            ));
        }
    }
    
     public function actionAjaxHtmlAddComponentCuAdditionalDetail($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $requirementDetail = $this->instantiate($id);
            $this->loadStateDetail($requirementDetail);

            if (isset($_POST['selectedCuAdditionalIds'])) {
                $componentsCuId = array();
                $componentsCuId = $_POST['selectedCuAdditionalIds'];

                foreach ($componentsCuId as $componentCuId) {
                    $requirementDetail->addDetailComponentAdditionalCu($componentCuId, $id);
                }
            } else if (isset($_POST['ComponentCuAdditionalId'])) {
                $requirementDetail->addDetailComponentAdditionalCu($_POST['ComponentCuAdditionalId'], $id);
            }

            $this->renderPartial('_detail_additional', array(
                'requirementDetail' => $requirementDetail,
            ));
        }
    }


    public function actionAjaxHtmlRemoveDetail($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $requirementDetail = $this->instantiate($id);

            $this->loadStateDetail($requirementDetail);

            $requirementDetail->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'requirementDetail' => $requirementDetail,
            ));
        }
    }
    
    public function actionAjaxHtmlRemoveDetailAdditional($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $requirementDetail = $this->instantiate($id);

            $this->loadStateDetail($requirementDetail);

            $requirementDetail->removeDetailAdditionalAt($index);

            $this->renderPartial('_detail_additional', array(
                'requirementDetail' => $requirementDetail,
            ));
        }
    }

}
