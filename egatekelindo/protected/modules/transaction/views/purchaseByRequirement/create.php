<?php
$this->breadcrumbs = array(
    'Purchase Order' => array('admin'),
    'Create',
);
?>

<h1>Purchase Order</h1>

<?php echo $this->renderPartial('_form', array(
    'purchase' => $purchase,
	'requirementHeader' => $requirementHeader,
	'supplier' => $supplier,
	'supplierDataProvider' => $supplierDataProvider,
));