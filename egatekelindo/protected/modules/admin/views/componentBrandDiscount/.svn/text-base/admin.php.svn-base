<?php
$this->breadcrumbs = array(
	'Component Brand Discounts'=>array('admin'),
	'Manage',
);

$this->menu = array(
//	array('label'=>'List ComponentBrandDiscount', 'url'=>array('index')),
	array('label'=>'Create ComponentBrandDiscount', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('component-brand-discount-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Component Brand Discounts</h1>

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
	'id'=>'component-brand-discount-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'header' => 'Merk',
            'name' => 'component_brand_id',
            'filter' => CHtml::listData(ComponentBrand::model()->findAll(), 'id', 'name'),
            'value' => 'CHtml::encode(CHtml::value($data, "componentBrand.name"))',
        ),
		'value_1',
		'value_2',
		'value_3',
		'value_4',
		'value_5',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
