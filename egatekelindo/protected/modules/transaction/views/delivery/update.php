<?php
$this->breadcrumbs = array(
    'Delivery' => array('admin'),
    'Create',
);
?>

<h1>Revisi Pengiriman Barang</h1>

<?php
echo $this->renderPartial('_form', array(
    'delivery' => $delivery,
    'saleOrder' => $saleOrder,
    'saleOrderDataProvider' => $saleOrderDataProvider,
));