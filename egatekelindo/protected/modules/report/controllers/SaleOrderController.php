<?php

class SaleOrderController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionSummary() {
        $saleOrder = Search::bind(new SaleOrder('search'), isset($_GET['SaleOrder']) ? $_GET['SaleOrder'] : array());

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $saleOrderSummary = new SaleOrderSummary($saleOrder->search());
        $saleOrderSummary->setupLoading();
        $saleOrderSummary->setupPaging($pageSize, $currentPage);
        $saleOrderSummary->setupSorting();
        $filters = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
        );
        $saleOrderSummary->setupFilter($filters);

        $this->render('summary', array(
            'saleOrder' => $saleOrder,
            'saleOrderSummary' => $saleOrderSummary,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currentSort' => $currentSort,
        ));
    }

}
