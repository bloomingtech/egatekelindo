<?php

class PartListController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionSummary() {
        $partListHeader = Search::bind(new PartListHeader('search'), isset($_GET['PartListHeader']) ? $_GET['PartListHeader'] : array());

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $partListSummary = new PartListSummary($partListHeader->search());
        $partListSummary->setupLoading();
        $partListSummary->setupPaging($pageSize, $currentPage);
        $partListSummary->setupSorting();
        $filters = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
        );
        $partListSummary->setupFilter($filters);

        $this->render('summary', array(
            'partListHeader' => $partListHeader,
            'partListSummary' => $partListSummary,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currentSort' => $currentSort,
        ));
    }

}
