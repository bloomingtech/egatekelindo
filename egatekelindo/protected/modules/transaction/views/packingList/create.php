<?php
$this->breadcrumbs = array(
	'Packing List'=>array('admin'),
	'Create',
);
?>

<h1>Packing List</h1>

<?php echo $this->renderPartial('_form', array(
	'packingList'=>$packingList,
	'partListHeader'=>$partListHeader,
	'partListHeaderDataProvider'=>$partListHeaderDataProvider,
));