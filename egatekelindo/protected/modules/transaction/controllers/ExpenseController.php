<?php

class ExpenseController extends Controller {

    public function filters() {
        return array(
//            'access',
        );
    }

    public function filterAccess($filterChain) {
        if ($filterChain->action->id === 'view'
                || $filterChain->action->id === 'create'
                || $filterChain->action->id === '/completion/account'
                || $filterChain->action->id === 'ajaxJsonCodeNumberAccount'
                || $filterChain->action->id === 'ajaxHtmlAddAccount'
                || $filterChain->action->id === 'ajaxJsonTotal'
                || $filterChain->action->id === 'ajaxHtmlRemoveAccount'
                || $filterChain->action->id === 'memo') {
            if (!(Yii::app()->user->checkAccess('bankExpenseCreate') || Yii::app()->user->checkAccess('bankExpenseEdit') || Yii::app()->user->checkAccess('cashExpenseCreate') || Yii::app()->user->checkAccess('cashExpenseEdit')))
                $this->redirect(array('/site/login'));
        }
        if ($filterChain->action->id === 'admin') {
            if (!(Yii::app()->user->checkAccess('bankExpenseEdit') || Yii::app()->user->checkAccess('cashExpenseEdit')))
                $this->redirect(array('/site/login'));
        }

        $filterChain->run();
    }

    public function actionCreate() {
        $expense = $this->instantiate(null);

        $expense->header->admin_id = 1;

        $expense->header->is_bank = intval(isset($_GET['bank']));
        $expenseHeaderText = ($expense->header->is_bank) ? 'Jurnal Pengeluaran Bank' : 'Jurnal Pengeluaran Kas';
        $expenseAccountCategory = ($expense->header->is_bank) ? '2' : '1';

        $account = Search::bind(new Account('search'), isset($_GET['Account']) ? $_GET['Account'] : array());
        $accountDataProvider = $account->search();
        $accountDataProvider->criteria->with = array(
            'accountCategory:resetScope',
        );


        if (isset($_POST['Submit'])) {
            $this->loadState($expense);
            $expense->generateCodeNumber(date('m'), date('y'));

            if ($expense->save(Yii::app()->db)) {
                Yii::app()->session['ExpenseMemoAllowed'] = true;

                if ($expense->header->is_bank) {
                    $this->redirect(array('view',
                        'id' => $expense->header->id,
                        'bank' => 1,
                    ));
                } else {
                    $this->redirect(array('view',
                        'id' => $expense->header->id,
                    ));
                }
            }
        }

        $this->render('create', array(
            'expense' => $expense,
            'account' => $account,
            'accountDataProvider' => $accountDataProvider,
            'expenseHeaderText' => $expenseHeaderText,
            'expenseAccountCategory' => $expenseAccountCategory,
        ));
    }

    public function actionUpdate($id) {
        $expense = $this->instantiate($id);

        $expense->header->admin_id = 1;

        $expenseHeaderText = ((int) $expense->header->is_bank === 1) ? 'Jurnal Pengeluaran Bank' : 'Jurnal Pengeluaran Kas';
        $expenseAccountCategory = ((int) $expense->header->is_bank === 1) ? '2' : '1';

        $account = Search::bind(new Account('search'), isset($_GET['Account']) ? $_GET['Account'] : array());
        $accountDataProvider = $account->search();
        $accountDataProvider->criteria->with = array(
            'accountCategory:resetScope',
        );

        if (isset($_POST['Submit'])) {
            $this->loadState($expense);

            if ($expense->save(Yii::app()->db)) {
                Yii::app()->session['ExpenseMemoAllowed'] = true;
                $this->redirect(array('view', 'id' => $expense->header->id));
            }
        }

        $this->render('create', array(
            'expense' => $expense,
            'account' => $account,
            'accountDataProvider' => $accountDataProvider,
            'expenseHeaderText' => $expenseHeaderText,
            'expenseAccountCategory' => $expenseAccountCategory,
        ));
    }

    public function actionView($id) {
        $expense = $this->loadModel($id);

        $account = $expense->account(array('scopes' => 'resetScope'));

        $expense->is_bank = intval(isset($_GET['bank']));

        $expenseCnConstant = null;
        if ($expense->is_bank)
            $expenseCnConstant = ExpenseHeader::CN_CONSTANT_BANK;
        else
            $expenseCnConstant = ExpenseHeader::CN_CONSTANT_CASH;

        $criteria = new CDbCriteria;
        $criteria->compare('expense_header_id', $expense->id);
        $detailsDataProvider = new CActiveDataProvider('ExpenseDetail', array(
                    'criteria' => $criteria,
                ));

        $detailsDataProvider->criteria->with = array(
            'account:resetScope'
        );

        $this->render('view', array(
            'expense' => $expense,
            'account' => $account,
            'detailsDataProvider' => $detailsDataProvider,
            'expenseCnConstan' => $expenseCnConstant,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $expense = $this->loadModel($id);
            if ($expense !== null) {
                $expense->is_inactive = ActiveRecord::INACTIVE;
                $expense->update(array('is_inactive'));

                foreach ($expense->expenseDetails as $expenseDetail) {
                    $expenseDetail->is_inactive = ActiveRecord::INACTIVE;
                    $expenseDetail->update(array('is_inactive'));
                }
            }

            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionMemo($id) {
        if (!(Yii::app()->user->checkAccess('administrator'))) {
            if (!(isset(Yii::app()->session['ExpenseMemoAllowed']) && Yii::app()->session['ExpenseMemoAllowed'] === true))
                $this->redirect(array('admin'));
        }

        Yii::app()->session->remove('ExpenseMemoAllowed');

        $expense = $this->loadModel($id);
        $account = $expense->account(array('scopes' => 'resetScope'));

        $expenseDetails = $expense->expenseDetails(array(
            'with' => array(
                'account:resetScope'
            ),
                ));

        $this->render('memo', array(
            'expense' => $expense,
            'account' => $account,
            'expenseDetails' => $expenseDetails,
        ));
    }

    public function actionAdmin() {
        $expense = Search::bind(new ExpenseHeader('search'), isset($_GET['ExpenseHeader']) ? $_GET['ExpenseHeader'] : array());

        $expense->is_bank = intval(isset($_GET['bank']));

        $dataProvider = $expense->search();
        $dataProvider->criteria->with = array(
            'account:resetScope',
        );

        $this->render('admin', array(
            'expense' => $expense,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAjaxHtmlAddAccount($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $expense = $this->instantiate($id);

            $this->loadState($expense);

            if (isset($_POST['AccountId']))
                $expense->addDetail($_POST['AccountId']);

            $this->renderPartial('_detail', array(
                'expense' => $expense,
            ));
        }
    }

    public function actionAjaxHtmlRemoveAccount($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $expense = $this->instantiate($id);

            $this->loadState($expense);

            $expense->removeDetailAt($index);

            $this->renderPartial('_detail', array(
                'expense' => $expense,
            ));
        }
    }

    public function actionAjaxJsonTotal($id, $index) {
        if (Yii::app()->request->isAjaxRequest) {
            $expense = $this->instantiate($id);

            $this->loadState($expense);

            $amount = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($expense->details[$index], 'amount')));
            $total = CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $expense->total));

            echo CJSON::encode(array(
                'amount' => $amount,
                'total' => $total,
            ));
        }
    }

    public function actionAjaxJsonCodeNumberAccount($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $expense = $this->instantiate($id);

            $this->loadState($expense);

            $expense->generateCodeNumber(date('m'), date('y'));

            if ($expense->header->is_bank) {
                $codeNumber = CHtml::encode($expense->header->getCodeNumber(ExpenseHeader::CN_CONSTANT_BANK));
            } else {
                $codeNumber = CHtml::encode($expense->header->getCodeNumber(ExpenseHeader::CN_CONSTANT_CASH));
            }


            $accounts = Account::model()->findAll('account_category_id IN (1, 2)');
            $accountList = CHtml::listData($accounts, 'id', 'name');
            $htmlOptions = array('empty' => '-- Pilih Akun --');
            $accountOptions = CHtml::listOptions('', $accountList, $htmlOptions);

            echo CJSON::encode(array(
                'codeNumber' => $codeNumber,
                'accountOptions' => $accountOptions,
            ));
        }
    }

    public function instantiate($id) {
        if (empty($id))
            $expense = new Expense(new ExpenseHeader(), array());
        else {
            $expenseHeader = $this->loadModel($id);
            $expense = new Expense($expenseHeader, $expenseHeader->expenseDetails);
        }

        return $expense;
    }

    public function loadModel($id) {
        $model = ExpenseHeader::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function loadState($expense) {
        if (isset($_POST['ExpenseHeader'])) {
            $expense->header->attributes = $_POST['ExpenseHeader'];
        }
        if (isset($_POST['ExpenseDetail'])) {
            foreach ($_POST['ExpenseDetail'] as $i => $item) {
                if (isset($expense->details[$i]))
                    $expense->details[$i]->attributes = $item;
                else {
                    $detail = new ExpenseDetail();
                    $detail->attributes = $item;
                    $expense->details[] = $detail;
                }
            }
            if (count($_POST['ExpenseDetail']) < count($expense->details))
                array_splice($expense->details, $i + 1);
        }
        else
            $expense->details = array();
    }

}
