<?php
$this->breadcrumbs = array(
    'Admins' => array('admin'),
    $model->name,
);

$this->menu = array(
//    array('label' => 'List Admin', 'url' => array('index')),
    array('label' => 'Create Admin', 'url' => array('create')),
    array('label' => 'Update Admin', 'url' => array('update', 'id' => $model->id)),
//	array('label'=>'Delete Admin', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this item?')),
    array('label' => 'Manage Admin', 'url' => array('admin')),
);
?>

<h1>View Admin #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'username',
        'name',
        'phone',
        'email',
        'status',
    ),
));
?>
