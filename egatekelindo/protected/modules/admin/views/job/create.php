<?php
$this->breadcrumbs = array(
	'Jobs'=>array('admin'),
	'Create',
);

$this->menu = array(
	array('label'=>'Manage Job', 'url'=>array('admin')),
);
?>

<h1>Create Job</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>