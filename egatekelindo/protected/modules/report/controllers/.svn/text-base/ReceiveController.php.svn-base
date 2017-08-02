<?php

class ReceiveController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionSummary() {
        $receiveHeader = Search::bind(new ReceiveHeader('search'), isset($_GET['ReceiveHeader']) ? $_GET['ReceiveHeader'] : array());

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';
        $supplierId = (isset($_GET['SupplierId'])) ? $_GET['SupplierId'] : '';

        $receiveSummary = new ReceiveSummary($receiveHeader->search());
        $receiveSummary->setupLoading();
        $receiveSummary->setupPaging($pageSize, $currentPage);
        $receiveSummary->setupSorting();
        $filters = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'supplierId' => $supplierId,
        );
        $receiveSummary->setupFilter($filters);

        $this->render('summary', array(
            'receiveHeader' => $receiveHeader,
            'receiveSummary' => $receiveSummary,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currentSort' => $currentSort,
            'supplierId' => $supplierId,
        ));
    }

}
