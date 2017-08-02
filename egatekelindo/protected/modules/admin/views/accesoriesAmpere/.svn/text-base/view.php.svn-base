<?php
$this->breadcrumbs = array(
	'Accesories Amperes'=>array('admin'),
	$model->name,
);

$this->menu = array(
//	array('label'=>'List AccesoriesAmpere', 'url'=>array('index')),
	array('label'=>'Create AccesoriesAmpere', 'url'=>array('create')),
	array('label'=>'Update AccesoriesAmpere', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete AccesoriesAmpere', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AccesoriesAmpere', 'url'=>array('admin')),
);
?>

<h1>View AccesoriesAmpere #<?php echo $model->id; ?></h1>

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
