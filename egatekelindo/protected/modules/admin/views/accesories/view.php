<?php
$this->breadcrumbs = array(
	'Accesories'=>array('admin'),
	$model->id,
);

$this->menu = array(
//	array('label'=>'List Accesories', 'url'=>array('index')),
	array('label'=>'Create Accesories', 'url'=>array('create')),
	array('label'=>'Update Accesories', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Accesories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Accesories', 'url'=>array('admin')),
);
?>

<h1>View Accesories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'type',
		'unit_price',
		array(
                    'label'=>'Material',
                    'value'=>CHtml::value($model,'material.name'),
                ),
		array(
                    'label'=>'Akesories Ampere',
                    'value'=>CHtml::value($model,'accesoriesAmpere.name'),
                ),
		array(
                    'label'=>'Kategori Accesories',
                    'value'=>CHtml::value($model,'accesoriesCategory.name')
                ),
		array(
			'label'=>'Status',
			'value'=>CHtml::encode(CHtml::value($model, 'status')),
		),
	),
)); ?>
