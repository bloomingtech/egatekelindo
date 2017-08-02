<?php
$this->breadcrumbs = array(
    'Receive' => array('admin'),
    'Update',
);
?>

<h1>Revisi Penerimaan</h1>

<?php
echo $this->renderPartial('_form', array(
    'receive' => $receive,
    'component' => $component,
    'dataProvider' => $dataProvider,
    'supplier' => $supplier,
    'supplierDataProvider' => $supplierDataProvider,
));
?>
