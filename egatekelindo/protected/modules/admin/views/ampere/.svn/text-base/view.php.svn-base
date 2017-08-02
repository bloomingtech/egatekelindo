<?php
$this->breadcrumbs = array(
	'Amperes'=>array('admin'),
	$model->name,
);

$this->menu = array(
//	array('label'=>'List Ampere', 'url'=>array('index')),
	array('label'=>'Create Ampere', 'url'=>array('create')),
	array('label'=>'Update Ampere', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Ampere', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ampere', 'url'=>array('admin')),
);
?>

<h1>View Ampere #<?php echo $model->id; ?></h1>

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
