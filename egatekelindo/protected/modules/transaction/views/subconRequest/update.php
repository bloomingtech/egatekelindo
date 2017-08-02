<?php
$this->breadcrumbs = array(
    'Subcon Request' => array('admin'),
    'Update',
);
?>

<h1>Revisi Subcon Request</h1>

<?php
echo $this->renderPartial('_form', array(
    'subconRequest' => $subconRequest,
    'component' => $component,
    'dataProvider' => $dataProvider,
    'saleOrder' => $saleOrder,
    'saleOrderDataProvider' => $saleOrderDataProvider
));
?>
