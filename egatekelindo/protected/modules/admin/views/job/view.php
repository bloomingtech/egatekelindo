<?php
$this->breadcrumbs = array(
	'Jobs'=>array('admin'),
	$model->name,
);

$this->menu = array(
	array('label'=>'Create Job', 'url'=>array('create')),
	array('label'=>'Update Job', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Job', 'url'=>array('admin')),
);
?>

<h1>View Job #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'name',
		'is_inactive',
	),
)); ?>
