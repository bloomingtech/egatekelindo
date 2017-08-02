<?php

class SubconRequestController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionSummary() {
        $subconRequestHeader = Search::bind(new SubconRequestHeader('search'), isset($_GET['SubconRequestHeader']) ? $_GET['SubconRequestHeader'] : array());

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $subconRequestSummary = new SubconRequestSummary($subconRequestHeader->search());
        $subconRequestSummary->setupLoading();
        $subconRequestSummary->setupPaging($pageSize, $currentPage);
        $subconRequestSummary->setupSorting();
        $filters = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
        );
        $subconRequestSummary->setupFilter($filters);

        $this->render('summary', array(
            'subconRequestHeader' => $subconRequestHeader,
            'subconRequestSummary' => $subconRequestSummary,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currentSort' => $currentSort,
        ));
    }

}
