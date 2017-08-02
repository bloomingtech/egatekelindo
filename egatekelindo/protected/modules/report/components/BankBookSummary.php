<?php

class BankBookSummary extends CComponent
{
	public $dataProvider;
	
	public function __construct($dataProvider)
	{
		$this->dataProvider = $dataProvider;
	}
	
	public function setupLoading()
	{
		$this->dataProvider->criteria->with = array(
                    'accountCategory:resetScope',
                    'branch:resetScope',
                    'supplier:resetScope',
                    );
		$this->dataProvider->criteria->compare('t.is_inactive', 0);
	}
	
	public function setupPaging($pageSize, $currentPage)
	{
		$pageSize = (empty($pageSize)) ? 10 : $pageSize;
		$pageSize = ($pageSize <= 0) ? 1 : $pageSize;
		$this->dataProvider->pagination->pageSize = $pageSize;
		
		$currentPage = (empty($currentPage)) ? 0 : $currentPage - 1;
		$this->dataProvider->pagination->currentPage = $currentPage;
	}
	
	public function setupSorting()
	{
		$this->dataProvider->sort->attributes = array('date', 'supplier.company');
		$this->dataProvider->criteria->order = $this->dataProvider->sort->orderBy;
	}
	
	public function setupFilter(array $filters)
	{
		$startDate = (empty($filters['startDate'])) ? date('Y-m-d') : $filters['startDate'];
		$endDate = (empty($filters['endDate'])) ? date('Y-m-d') : $filters['endDate'];
		
		$this->dataProvider->criteria->addBetweenCondition('t.date', $startDate, $endDate);
		$this->dataProvider->criteria->compare('t.account_id', $filters['accountId']);
		$this->dataProvider->criteria->compare('t.branch_id', $filters['branchId']);
		
	}
	
	public function setupBranch($branch)
	{		
		$this->dataProvider->criteria->compare('branch_id', $branch);
	}
	
	public function getGrandTotal()
	{
		$grandTotal = 0.00;

		foreach ($this->dataProvider->data as $data)
			$grandTotal += $data->grandTotal;

		return $grandTotal;
	}
}
