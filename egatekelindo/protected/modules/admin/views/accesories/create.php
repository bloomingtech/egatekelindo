<?php
$this->breadcrumbs = array(
	'Accesories'=>array('admin'),
	'Create',
);

$this->menu = array(
//	array('label'=>'List Accesories', 'url'=>array('index')),
	array('label'=>'Manage Accesories', 'url'=>array('admin')),
);
?>

<h1>Create Accesories</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>