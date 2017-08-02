<?php
$this->breadcrumbs = array(
	'Amperes'=>array('admin'),
	'Create',
);

$this->menu = array(
//	array('label'=>'List Ampere', 'url'=>array('index')),
	array('label'=>'Manage Ampere', 'url'=>array('admin')),
);
?>

<h1>Create Ampere</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>