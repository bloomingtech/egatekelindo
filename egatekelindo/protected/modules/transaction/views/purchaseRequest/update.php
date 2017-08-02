<?php
	$this->breadcrumbs = array(
		'Purchase Request'=>array('admin'),
		'Update',
	);
?>

<h1>Revisi Purchase Request</h1>

<?php echo $this->renderPartial('_form', array(
		'purchaseRequest'=>$purchaseRequest,
		'component' => $component,
		'componentDataProvider' => $componentDataProvider,
)); ?>
