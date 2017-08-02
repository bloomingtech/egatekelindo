<?php
$this->breadcrumbs = array(
	'Accesories'=>array('admin'),
	$model->id=>array('view', 'id'=>$model->id),
	'Update',
);

$this->menu = array(
//	array('label'=>'List Accesories', 'url'=>array('index')),
	array('label'=>'Create Accesories', 'url'=>array('create')),
	array('label'=>'View Accesories', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Accesories', 'url'=>array('admin')),
);
?>

<h1>Update Accesories <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>