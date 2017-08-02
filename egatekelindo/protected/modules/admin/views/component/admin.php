<?php
$this->breadcrumbs = array(
    'Components' => array('admin'),
    'Manage',
);

$this->menu = array(
//    array('label' => 'List Component', 'url' => array('index')),
    array('label' => 'Create Component', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('component-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Components</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'component-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'code',
        'name',
        array(
            'header' => 'Merk',
            'name' => 'component_brand_id',
            'filter' => CHtml::listData(ComponentBrand::model()->findAll(), 'id', 'name'),
            'value' => 'CHtml::encode(CHtml::value($data, "componentBrand.name"))',
        ),
        'type',
		array(
            'header' => 'Kategori',
            'name' => 'component_category_id',
            'filter' => CHtml::listData(ComponentCategory::model()->findAll(), 'id', 'name'),
            'value' => 'CHtml::encode(CHtml::value($data, "componentCategory.name"))',
        ),
		array(
            'header' => 'Grup',
            'name' => 'component_group_id',
            'filter' => CHtml::listData(ComponentGroup::model()->findAll(), 'id', 'name'),
            'value' => 'CHtml::encode(CHtml::value($data, "componentGroup.name"))',
        ),
        array(
            'name' => 'is_inactive',
            'filter' => array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive'),
            'value' => 'CHtml::encode(CHtml::value($data, "status"))',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
        ),
    ),
));
?>
