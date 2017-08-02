<?php
$this->breadcrumbs = array(
	'Jobs'=>array('create'),
	'Manage',
);

$this->menu = array(
	array('label'=>'Create Job', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('job-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Jobs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'job-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'code',
		'name',
		'is_inactive',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
