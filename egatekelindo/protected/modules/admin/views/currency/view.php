<?php
$this->breadcrumbs = array(
	'Currencies'=>array('admin'),
	$model->name,
);

$this->menu = array(
//	array('label'=>'List Currency', 'url'=>array('index')),
	array('label'=>'Create Currency', 'url'=>array('create')),
	array('label'=>'Update Currency', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Currency', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Currency', 'url'=>array('admin')),
);
?>

<h1>View Currency #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		array(
			'label'=>'Status',
			'value'=>CHtml::encode(CHtml::value($model, 'status')),
		),
	),
)); ?>