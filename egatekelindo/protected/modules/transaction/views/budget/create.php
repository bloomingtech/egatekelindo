<?php
$this->breadcrumbs = array(
    'Budget Headers' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List EstimationHeader', 'url' => array('index')),
    array('label' => 'Manage EstimationHeader', 'url' => array('admin')),
);
?>

<h1>Create Budget</h1>

<?php
echo $this->renderPartial('_form', array(
    'budget' => $budget,
    'saleOrderHeader' => $saleOrderHeader,
    'saleOrderHeaderDataProvider' => $saleOrderHeaderDataProvider,
));
?>