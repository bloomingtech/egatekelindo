<?php

class MaterialCheckoutController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionSummary() {
        $materialCheckoutHeader = Search::bind(new MaterialCheckoutHeader('search'), isset($_GET['MaterialCheckoutHeader']) ? $_GET['MaterialCheckoutHeader'] : array());

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $materialCheckoutSummary = new MaterialCheckoutSummary($materialCheckoutHeader->search());
        $materialCheckoutSummary->setupLoading();
        $materialCheckoutSummary->setupPaging($pageSize, $currentPage);
        $materialCheckoutSummary->setupSorting();
        $filters = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
        );
        $materialCheckoutSummary->setupFilter($filters);

        $this->render('summary', array(
            'materialCheckoutHeader' => $materialCheckoutHeader,
            'materialCheckoutSummary' => $materialCheckoutSummary,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currentSort' => $currentSort,
        ));
    }

}
