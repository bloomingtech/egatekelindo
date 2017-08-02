<?php
$this->breadcrumbs = array(
    'Components' => array('admin'),
    $model->name,
);

$this->menu = array(
//    array('label' => 'List Component', 'url' => array('index')),
    array('label' => 'Create Component', 'url' => array('create')),
    array('label' => 'Update Component', 'url' => array('update', 'id' => $model->id)),
//    array('label' => 'Delete Component', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Component', 'url' => array('admin')),
);
?>

<h1>View Component #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'code',
        'name',
        array(
            'label' => 'Budget Price',
            'value' => CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($model, 'budget_price'))),
        ),
        array(
            'label' => 'Merk',
            'value' => CHtml::value($model, 'componentBrand.name'),
        ),
        'type',
		array(
            'label' => 'Kategori',
            'value' => CHtml::value($model, 'componentCategory.name'),
        ),
		array(
            'label' => 'Grup',
            'value' => CHtml::value($model, 'componentGroup.name'),
        ),
        array(
            'label' => 'Faktor Pengali',
            'value' => CHtml::value($model, 'componentBrandDiscount.componentBrand.name'),
        ),
		'note',
//        array(
//            'label' => 'Akesories ?',
//            'value' => $model->is_accesories ? 'YES' : 'NO',
//        ),
        array(
            'label' => 'Status',
            'value' => CHtml::encode(CHtml::value($model, 'status')),
        ),
    ),
));
?>
