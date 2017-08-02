<?php
$this->breadcrumbs = array(
	'Customers'=>array('admin'),
	$model->name,
);

$this->menu = array(
//	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'Update Customer', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Customer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Customer', 'url'=>array('admin')),
);
?>

<h1>View Customer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'company',
                'address',
		'phone',
		'fax',
                'tax_number',
		'status',
	),
)); ?>
