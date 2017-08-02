<?php

class PackingListController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionSummary() {
        $packingListHeader = Search::bind(new PackingListHeader('search'), isset($_GET['PackingListHeader']) ? $_GET['PackingListHeader'] : array());

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $packingListSummary = new PackingListSummary($packingListHeader->search());
        $packingListSummary->setupLoading();
        $packingListSummary->setupPaging($pageSize, $currentPage);
        $packingListSummary->setupSorting();
        $filters = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
        );
        $packingListSummary->setupFilter($filters);

        $this->render('summary', array(
            'packingListHeader' => $packingListHeader,
            'packingListSummary' => $packingListSummary,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currentSort' => $currentSort,
        ));
    }

}
