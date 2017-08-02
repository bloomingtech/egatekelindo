<?php
$this->breadcrumbs = array(
    'Requirement' => array('admin'),
    'Create',
);
?>

<h1>Requirement</h1>

<?php
echo $this->renderPartial('_form', array(
    'requirement' => $requirement,
//    'saleOrderHeader' => $saleOrderHeader,
//    'saleOrderHeaderDataProvider' => $saleOrderHeaderDataProvider,
));