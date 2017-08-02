<?php
$this->breadcrumbs = array(
    'Budget Headers' => array('index'),
    $budget->header->id => array('view', 'id' => $budget->header->id),
    'Update',
);
?>

<h1>Update Budget</h1>

<?php
echo $this->renderPartial('_form', array(
    'budget' => $budget,
    'saleOrderHeader' => $saleOrderHeader,
    'saleOrderHeaderDataProvider' => $saleOrderHeaderDataProvider,
));
?>