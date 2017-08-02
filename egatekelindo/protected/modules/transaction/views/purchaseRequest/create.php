<?php
	$this->breadcrumbs = array(
		'Purchase Request'=>array('admin'),
		'Create',
	);
?>
<h1>Purchase Request</h1>

<?php echo $this->renderPartial('_form', array(
	'purchaseRequest' => $purchaseRequest,
	'component' => $component,
	'componentDataProvider' => $componentDataProvider,
	'workOrderProduction' => $workOrderProduction,
	'workOrderProductionDataProvider' => $workOrderProductionDataProvider,
));?>
