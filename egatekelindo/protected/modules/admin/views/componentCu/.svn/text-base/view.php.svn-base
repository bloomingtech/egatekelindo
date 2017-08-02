<?php
$this->breadcrumbs = array(
    'Component Cus' => array('admin'),
    $model->name,
);

$this->menu = array(
//    array('label' => 'List ComponentCu', 'url' => array('index')),
    array('label' => 'Create ComponentCu', 'url' => array('create')),
    array('label' => 'Update ComponentCu', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Manage ComponentCu', 'url' => array('admin')),
);
?>

<h1>View ComponentCu #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'weight',
        array(
            'label' => 'Component Brand Discount',
            'value' => CHtml::value($model, 'componentBrandDiscount.value'),
        ),
        array(
            'label' => 'Unit',
            'value' => CHtml::value($model, 'unit.name'),
        ),
        array(
            'label' => 'Status',
            'value' => CHtml::encode(CHtml::value($model, 'status')),
        ),
    ),
));
?>
