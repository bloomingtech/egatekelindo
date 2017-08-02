<?php

class PurchaseRequestController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionSummary() {
        $purchaseRequestHeader = Search::bind(new PurchaseRequestHeader('search'), isset($_GET['PurchaseRequestHeader']) ? $_GET['PurchaseRequestHeader'] : array());

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $purchaseRequestSummary = new PurchaseRequestSummary($purchaseRequestHeader->search());
        $purchaseRequestSummary->setupLoading();
        $purchaseRequestSummary->setupPaging($pageSize, $currentPage);
        $purchaseRequestSummary->setupSorting();
        $filters = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
        );
        $purchaseRequestSummary->setupFilter($filters);

        $this->render('summary', array(
            'purchaseRequestHeader' => $purchaseRequestHeader,
            'purchaseRequestSummary' => $purchaseRequestSummary,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currentSort' => $currentSort,
        ));
    }

}
