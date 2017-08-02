<?php
$this->breadcrumbs = array(
	'Component Brands'=>array('admin'),
	$model->name,
);

$this->menu = array(
//	array('label'=>'List ComponentBrand', 'url'=>array('index')),
	array('label'=>'Create ComponentBrand', 'url'=>array('create')),
	array('label'=>'Update ComponentBrand', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete ComponentBrand', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ComponentBrand', 'url'=>array('admin')),
);
?>

<h1>View ComponentBrand #<?php echo $model->id; ?></h1>

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
