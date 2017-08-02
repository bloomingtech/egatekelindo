<?php

class SaleReturnController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionSummary() {
        $saleReturnHeader = Search::bind(new SaleReturnHeader('search'), isset($_GET['SaleReturnHeader']) ? $_GET['SaleReturnHeader'] : array());

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $saleReturnSummary = new SaleReturnSummary($saleReturnHeader->search());
        $saleReturnSummary->setupLoading();
        $saleReturnSummary->setupPaging($pageSize, $currentPage);
        $saleReturnSummary->setupSorting();
        $filters = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
        );
        $saleReturnSummary->setupFilter($filters);

        $this->render('summary', array(
            'saleReturnHeader' => $saleReturnHeader,
            'saleReturnSummary' => $saleReturnSummary,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currentSort' => $currentSort,
        ));
    }

}
