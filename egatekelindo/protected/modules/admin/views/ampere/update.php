<?php
$this->breadcrumbs = array(
	'Amperes'=>array('admin'),
	$model->name=>array('view', 'id'=>$model->id),
	'Update',
);

$this->menu = array(
//	array('label'=>'List Ampere', 'url'=>array('index')),
	array('label'=>'Create Ampere', 'url'=>array('create')),
	array('label'=>'View Ampere', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Ampere', 'url'=>array('admin')),
);
?>

<h1>Update Ampere <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>