<?php
$this->breadcrumbs = array(
	'Accesories Categories'=>array('admin'),
	'Manage',
);

$this->menu = array(
//	array('label'=>'List AccesoriesCategory', 'url'=>array('index')),
	array('label'=>'Create AccesoriesCategory', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('accesories-category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Accesories Categories</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'accesories-category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		array(
			'name'=>'is_inactive',
			'filter' => array(ActiveRecord::ACTIVE=>'Active', ActiveRecord::INACTIVE=>'Inactive'),
			'value'=>'CHtml::encode(CHtml::value($data, "status"))',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
