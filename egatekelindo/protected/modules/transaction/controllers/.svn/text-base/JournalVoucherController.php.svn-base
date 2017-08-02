<?php

class JournalVoucherController extends Controller {

    public function filters() {
        return array(
//            'access',
        );
    }

    public function actionCreate() {
        $journal = $this->instantiate(null);
        $journal->header->admin_id = 1;

        $account = Search::bind(new Account('search'), isset($_GET['Account']) ? $_GET['Account'] : array());
        $accountDataProvider = $account->search();
        $accountDataProvider->criteria->with = array(
            'accountCategory:resetScope',
        );

        if (isset($_POST['Submit'])) {
            $this->loadState($journal);
            $journal->generateCodeNumber(date('m'), date('y'));

            if ($journal->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $journal->header->id));
        }

        $this->render('create', array(
            'journal' => $journal,
            'account' => $account,
            'accountDataProvider' => $accountDataProvider,
        ));
    }

    public function actionUpdate($id) {
        $journal = $this->instantiate($id);

        $account = Search::bind(new Account('search'), isset($_GET['Account']) ? $_GET['Account'] : array());
        $accountDataProvider = $account->search();
        $accountDataProvider->criteria->with = array(
            'accountCategory:resetScope',
        );

        if (isset($_POST['Submit'])) {
            $this->loadState($journal);

            if ($journal->save(Yii::app()->db))
                $this->redirect(array('view', 'id' => $journal->header->id));
        }

        $this->render('update', array(
            'journal' => $journal,
            'account' => $account,
            'accountDataProvider' => $accountDataProvider,
        ));
    }

    public function actionView($id) {
        $journal = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->compare('journal_voucher_header_id', $journal->id);
        $detailsDataProvider = new CActiveDataProvider('JournalVoucherDetail', array(
                    'criteria' => $criteria,
                ));

        $detailsDataProvider->criteria->with = array(
            'account:resetScope'
        );

        $this->render('view', array(
            'journal' => $journal,
            'detailsDataProvider' => $detailsDataProvider,
        ));
    }

    public function actionAdmin() {
        $journal = Search::bind(new JournalVoucherHeader('search'), isset($_GET['JournalVoucherHeader']) ? $_GET['JournalVoucherHeader'] : array());
        $dataProvider = $journal->search();

        $this->render('admin', array(
            'journal' => $journal,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAjaxHtmlAddAccount($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $journal = $this->instantiate($id);

            $this->loadState($journal);

            if (isset($_POST['AccountId']))
                $journal->addDetail($_POST['AccountId']);

            $this->renderPartial('_detail', array(
                'journal' => $journal,
            ));
        }
    }

    public function actionAjaxHtmlRemoveAccount($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $journal = $this->instantiate($id);

            $this->loadState($journal);

            $journal->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'journal' => $journal,
            ));
        }
    }

    public function actionAjaxJsonTotalDebit($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $journal = $this->instantiate($id);

            $this->loadState($journal);

            $debit = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($journal->details[$index], 'debit')));
            $totalDebit = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $journal->totalDebit));

            echo CJSON::encode(array(
                'debit' => $debit,
                'totalDebit' => $totalDebit,
            ));
        }
    }

    public function actionAjaxJsonTotalCredit($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $journal = $this->instantiate($id);

            $this->loadState($journal);

            $credit = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($journal->details[$index], 'credit')));
            $totalCredit = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $journal->totalCredit));

            echo CJSON::encode(array(
                'credit' => $credit,
                'totalCredit' => $totalCredit,
            ));
        }
    }

    public function actionAjaxJsonCodeNumber($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $journal = $this->instantiate($id);

            $this->loadState($journal);

            $journal->generateCodeNumber(date('m'), date('y'));
            $codeNumber = CHtml::encode($journal->header->getCodeNumber(JournalVoucherHeader::CN_CONSTANT));

            echo CJSON::encode(array(
                'codeNumber' => $codeNumber,
            ));
        }
    }

    public function instantiate($id) {
        if (empty($id))
            $journal = new JournalVoucher(new JournalVoucherHeader(), array());
        else {
            $journalVoucherHeader = $this->loadModel($id);
            $journal = new JournalVoucher($journalVoucherHeader, $journalVoucherHeader->journalVoucherDetails);
        }

        return $journal;
    }

    public function loadModel($id) {
        $model = JournalVoucherHeader::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    protected function loadState($journal) {
        if (isset($_POST['JournalVoucherHeader']))
            $journal->header->attributes = $_POST['JournalVoucherHeader'];

        if (isset($_POST['JournalVoucherDetail'])) {
            foreach ($_POST['JournalVoucherDetail'] as $i => $item) {
                if (isset($journal->details[$i]))
                    $journal->details[$i]->attributes = $item;
                else {
                    $detail = new JournalVoucherDetail();
                    $detail->attributes = $item;
                    $journal->details[] = $detail;
                }
                if (count($_POST['JournalVoucherDetail']) < count($journal->details))
                    array_splice($journal->details, $i + 1);
            }
        }
        else
            $journal->details = array();
    }

}
