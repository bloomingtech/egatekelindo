<?php
$this->breadcrumbs = array(
	'Component Brand Discounts',
);

$this->menu = array(
	array('label'=>'Create ComponentBrandDiscount', 'url'=>array('create')),
	array('label'=>'Manage ComponentBrandDiscount', 'url'=>array('admin')),
);
?>

<h1>Component Brand Discounts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
