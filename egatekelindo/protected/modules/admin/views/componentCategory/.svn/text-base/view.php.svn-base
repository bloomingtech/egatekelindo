<?php
$this->breadcrumbs = array(
    'Component Categories' => array('admin'),
    $model->name,
);

$this->menu = array(
//    array('label' => 'List ComponentCategory', 'url' => array('index')),
    array('label' => 'Create ComponentCategory', 'url' => array('create')),
    array('label' => 'Update ComponentCategory', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Manage ComponentCategory', 'url' => array('admin')),
);
?>

<h1>View ComponentCategory #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        array(
            'label' => 'Component Category',
            'value' => CHtml::value($model, 'componentCategory.name'),
        ),
        'status',
    ),
));
?>
