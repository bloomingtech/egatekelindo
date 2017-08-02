<?php
$this->breadcrumbs = array(
    'Component Brand Discounts' => array('admin'),
    $model->id,
);

$this->menu = array(
//    array('label' => 'List ComponentBrandDiscount', 'url' => array('index')),
    array('label' => 'Create ComponentBrandDiscount', 'url' => array('create')),
    array('label' => 'Update ComponentBrandDiscount', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Manage ComponentBrandDiscount', 'url' => array('admin')),
);
?>

<h1>View ComponentBrandDiscount #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'value_1',
        'value_2',
        'value_3',
        'value_4',
        'value_5',
        'currency_id',
        array(
            'label' => 'Component Brand',
            'value' => CHtml::value($model, 'componentBrand.name'),
        ),
        'status',
    ),
));
?>
