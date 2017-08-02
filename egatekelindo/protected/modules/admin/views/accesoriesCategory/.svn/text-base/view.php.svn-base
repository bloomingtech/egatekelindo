<?php
$this->breadcrumbs = array(
	'Accesories Categories'=>array('admin'),
	$model->name,
);

$this->menu = array(
//	array('label'=>'List AccesoriesCategory', 'url'=>array('index')),
	array('label'=>'Create AccesoriesCategory', 'url'=>array('create')),
	array('label'=>'Update AccesoriesCategory', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete AccesoriesCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AccesoriesCategory', 'url'=>array('admin')),
);
?>

<h1>View AccesoriesCategory #<?php echo $model->id; ?></h1>

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
