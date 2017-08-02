<?php
$this->breadcrumbs = array(
	'Component Categories'=>array('admin'),
	'Create',
);

$this->menu = array(
//	array('label'=>'List ComponentCategory', 'url'=>array('index')),
	array('label'=>'Manage ComponentCategory', 'url'=>array('admin')),
);
?>

<h1>Create ComponentCategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>