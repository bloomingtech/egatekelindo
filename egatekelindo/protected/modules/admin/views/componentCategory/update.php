<?php
$this->breadcrumbs = array(
	'Component Categories'=>array('admin'),
	$model->name=>array('view', 'id'=>$model->id),
	'Update',
);

$this->menu = array(
//	array('label'=>'List ComponentCategory', 'url'=>array('index')),
	array('label'=>'Create ComponentCategory', 'url'=>array('create')),
	array('label'=>'View ComponentCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ComponentCategory', 'url'=>array('admin')),
);
?>

<h1>Update ComponentCategory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>