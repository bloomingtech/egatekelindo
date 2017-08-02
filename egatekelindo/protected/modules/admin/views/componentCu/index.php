<?php
$this->breadcrumbs = array(
	'Component Cus',
);

$this->menu = array(
	array('label'=>'Create ComponentCu', 'url'=>array('create')),
	array('label'=>'Manage ComponentCu', 'url'=>array('admin')),
);
?>

<h1>Component Cus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
