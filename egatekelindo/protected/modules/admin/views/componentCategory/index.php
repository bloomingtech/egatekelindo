<?php
$this->breadcrumbs = array(
	'Component Categories',
);

$this->menu = array(
	array('label'=>'Create ComponentCategory', 'url'=>array('create')),
	array('label'=>'Manage ComponentCategory', 'url'=>array('admin')),
);
?>

<h1>Component Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
