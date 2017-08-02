<?php

class GeneralLedgerController extends Controller
{
	public function filters()
	{
		return array(
//			'access',
		);
	}

	public function filterAccess($filterChain)
	{
		if ($filterChain->action->id === 'summary'
			|| $filterChain->action->id === 'ajaxHtmlAccount')
		{
			if (!(Yii::app()->user->checkAccess('generalLedgerReport')))
				$this->redirect(array('/site/login'));
		}

		$filterChain->run();
	}
	
	public function actionSummary()
	{
		$account = Search::bind(new Account('search'), isset($_GET['Account']) ? $_GET['Account'] : array());
		$journalAccounting = Search::bind(new JournalAccounting('search'), isset($_GET['JournalAccounting'])? $_GET['JournalAccounting'] : array());
		
		$startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : date('Y-m-d');
		$endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : date('Y-m-d');
		$pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
		$currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
		$currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

		$number= (isset($_GET['Number'])) ? $_GET['Number'] : '';
		
		$startAccount = (isset($_GET['StartAccount'])) ? $_GET['StartAccount'] : '';
		$endAccount = (isset($_GET['EndAccount'])) ? $_GET['EndAccount'] : '';
		
		$accounts = Account::model()->findAll(
			array(
				'order' => 'code ASC',
			)
		);
		
		$generalLedgerSummary = new GeneralLedgerSummary($account->search(),$journalAccounting->search());
		$generalLedgerSummary->setupLoading($startDate, $endDate,$startAccount, $endAccount);
		$generalLedgerSummary->setupPaging($pageSize, $currentPage);
		$generalLedgerSummary->setupSorting();
		$generalLedgerSummary->setupFilter($startDate, $endDate, $startAccount, $endAccount);
		$generalLedgerSummary->getSaldo($startDate);
		
		//$beginningBalanceLedger = $generalLedgerSummary->beginningLedgerSummary($generalLedgerSummary->id,$startDate);
		
		$this->render('summary', array(
			'account' => $account,
			'journalAccounting' => $journalAccounting,
			'generalLedgerSummary' => $generalLedgerSummary,
			'startDate' => $startDate,
			'endDate' => $endDate,
			'currentSort' => $currentSort,
			'number' => $number,
			'accounts' => $accounts,
			'startAccount' => $startAccount,
			'endAccount' => $endAccount,
			
		));
	}
	
	protected function reportGrandTotal($dataProvider)
	{
		$grandTotal = 0.00;

		foreach ($dataProvider->data as $data)
			$grandTotal += $data->amountPaid;

		return $grandTotal;
	}
	
	public function actionAjaxHtmlAccount()									
	{
		if (Yii::app()->request->isAjaxRequest)
		{
			
			$startAccount = (isset($_GET['StartAccount'])) ? $_GET['StartAccount'] : '';
			$endAccount = (isset($_GET['EndAccount'])) ? $_GET['EndAccount'] : '';
			
			$accounts = Account::model()->findAll(
				array(
					'order' => 'code ASC',
				)
			);
			
			$account = Search::bind(new Account('search'), isset($_GET['Account']) ? $_GET['Account'] : array());
			
			$this->renderPartial('_account', array(
				'account' => $account,
				'accounts' => $accounts,
				'startAccount' => $startAccount,
				'endAccount' => $endAccount,
			));
		}
	}
        
       
}
