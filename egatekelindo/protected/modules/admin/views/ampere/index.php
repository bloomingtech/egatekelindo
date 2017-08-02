<?php
$this->breadcrumbs = array(
	'Amperes',
);

$this->menu = array(
	array('label'=>'Create Ampere', 'url'=>array('create')),
	array('label'=>'Manage Ampere', 'url'=>array('admin')),
);
?>

<h1>Amperes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
