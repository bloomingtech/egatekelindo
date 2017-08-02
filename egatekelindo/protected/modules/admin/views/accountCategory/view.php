<?php
$this->breadcrumbs = array(
	'Account Categories'=>array('admin'),
	$model->name,
);

$this->menu = array(
//	array('label'=>'List AccountCategory', 'url'=>array('index')),
	array('label'=>'Create AccountCategory', 'url'=>array('create')),
	array('label'=>'Update AccountCategory', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete AccountCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AccountCategory', 'url'=>array('admin')),
);
?>

<h1>View AccountCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		 array(
                    'label' => 'Account Category',
                    'value' => CHtml::value($model, 'accountCategory.name'),
                ),
		'status',
	),
)); ?>
