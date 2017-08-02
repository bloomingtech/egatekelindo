<?php

class SalePaymentController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionSummary() {
        $salePaymentHeader = Search::bind(new SalePaymentHeader('search'), isset($_GET['SalePaymentHeader']) ? $_GET['SalePaymentHeader'] : array());

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $salePaymentSummary = new SalePaymentSummary($salePaymentHeader->search());
        $salePaymentSummary->setupLoading();
        $salePaymentSummary->setupPaging($pageSize, $currentPage);
        $salePaymentSummary->setupSorting();
        $filters = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
        );
        $salePaymentSummary->setupFilter($filters);

        $this->render('summary', array(
            'salePaymentHeader' => $salePaymentHeader,
            'salePaymentSummary' => $salePaymentSummary,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currentSort' => $currentSort,
        ));
    }

}
