<?php
$this->breadcrumbs = array(
	'PartList'=>array('admin'),
	'Create',
);
?>

<h1>Part List</h1>

<?php echo $this->renderPartial('_form', array(
	'partList'=>$partList,
	'saleOrder'=>$saleOrder,
	'saleOrderDataProvider'=>$saleOrderDataProvider,
	'component' => $component,
	'dataProvider' => $dataProvider,
));