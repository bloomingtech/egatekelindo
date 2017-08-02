<?php

class SaleInvoiceController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionSummary() {
        $saleInvoiceHeader = Search::bind(new SaleInvoiceHeader('search'), isset($_GET['SaleInvoiceHeader']) ? $_GET['SaleInvoiceHeader'] : array());

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $saleInvoiceSummary = new SaleInvoiceSummary($saleInvoiceHeader->search());
        $saleInvoiceSummary->setupLoading();
        $saleInvoiceSummary->setupPaging($pageSize, $currentPage);
        $saleInvoiceSummary->setupSorting();
        $filters = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
        );
        $saleInvoiceSummary->setupFilter($filters);

        $this->render('summary', array(
            'saleInvoiceHeader' => $saleInvoiceHeader,
            'saleInvoiceSummary' => $saleInvoiceSummary,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currentSort' => $currentSort,
        ));
    }

}
