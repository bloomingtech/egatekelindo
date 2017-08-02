<?php
	$this->breadcrumbs = array(
		'Sales Order'=>array('admin'),
		'Create',
	);
?>

<h1>Sales Order</h1>

<?php echo $this->renderPartial('_form', array(
	'saleOrder' => $saleOrder,
        'customer' => $customer,
        'customerDataProvider' => $customerDataProvider,
        'model' => $model
));?>
