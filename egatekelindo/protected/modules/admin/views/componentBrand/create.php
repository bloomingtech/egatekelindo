<?php
$this->breadcrumbs = array(
	'Component Brands'=>array('admin'),
	'Create',
);

$this->menu = array(
//	array('label'=>'List ComponentBrand', 'url'=>array('index')),
	array('label'=>'Manage ComponentBrand', 'url'=>array('admin')),
);
?>

<h1>Create ComponentBrand</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>