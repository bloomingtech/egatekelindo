<?php

class DeliveryController extends Controller {

    public function filters() {
        return array(
//			'access',
        );
    }

    public function actionSummary() {
        $deliveryHeader = Search::bind(new DeliveryHeader('search'), isset($_GET['DeliveryHeader']) ? $_GET['DeliveryHeader'] : array());

        $startDate = (isset($_GET['StartDate'])) ? $_GET['StartDate'] : '';
        $endDate = (isset($_GET['EndDate'])) ? $_GET['EndDate'] : '';
        $pageSize = (isset($_GET['PageSize'])) ? $_GET['PageSize'] : '';
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : '';
        $currentSort = (isset($_GET['sort'])) ? $_GET['sort'] : '';

        $deliverySummary = new DeliverySummary($deliveryHeader->search());
        $deliverySummary->setupLoading();
        $deliverySummary->setupPaging($pageSize, $currentPage);
        $deliverySummary->setupSorting();
        $filters = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
        );
        $deliverySummary->setupFilter($filters);

        $this->render('summary', array(
            'deliveryHeader' => $deliveryHeader,
            'deliverySummary' => $deliverySummary,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currentSort' => $currentSort,
        ));
    }

}
