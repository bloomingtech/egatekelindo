<?php
$this->breadcrumbs = array(
	'Currencies'=>array('admin'),
	$model->name=>array('view', 'id'=>$model->id),
	'Update',
);

$this->menu = array(
//	array('label'=>'List Currency', 'url'=>array('index')),
	array('label'=>'Create Currency', 'url'=>array('create')),
	array('label'=>'View Currency', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Currency', 'url'=>array('admin')),
);
?>

<h1>Update Currency <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>