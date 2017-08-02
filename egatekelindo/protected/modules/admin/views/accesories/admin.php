<?php
$this->breadcrumbs = array(
	'Accesories'=>array('admin'),
	'Manage',
);

$this->menu = array(
//	array('label'=>'List Accesories', 'url'=>array('index')),
	array('label'=>'Create Accesories', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('accesories-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Accesories</h1>

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
	'id'=>'accesories-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'type',
		'unit_price',
		array(
			'header' => 'Material',
			'name' => 'material_id',
			'filter' => CHtml::listData(Material::model()->findAll(), 'id', 'name'),
			'value' => 'CHtml::encode(CHtml::value($data, "material.name"))',
		),
		array(
			'header' => 'Ampere',
			'name' => 'accesories_ampere_id',
			'filter' => CHtml::listData(AccesoriesAmpere::model()->findAll(), 'id', 'name'),
			'value' => 'CHtml::encode(CHtml::value($data, "accesoriesAmpere.name"))',
		),
		array(
			'header' => 'Accesories Category',
			'name' => 'accesories_category_id',
			'filter' => CHtml::listData(AccesoriesCategory::model()->findAll(), 'id', 'name'),
			'value' => 'CHtml::encode(CHtml::value($data, "accesoriesCategory.name"))',
		),
		/*
		'is_inactive',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
