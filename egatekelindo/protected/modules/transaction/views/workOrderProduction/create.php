<?php
$this->breadcrumbs = array(
    'Work Order Production' => array('admin'),
    'Create',
);
?>

<h1>SPK Produksi</h1>

<?php
echo $this->renderPartial('_form', array(
    'workOrderProduction' => $workOrderProduction,
//    'workOrderDrawing' => $workOrderDrawing,
//    'workOrderDrawingDataProvider' => $workOrderDrawingDataProvider,
));