<?php
$this->breadcrumbs = array(
    'Retur Penjualan' => array('admin'),
    'Create',
);
?>

<h1>Retur Penjualan</h1>

<?php
echo $this->renderPartial('_form', array(
    'saleReturn' => $saleReturn,
    'saleOrder' => $saleOrder,
    'saleOrderDataProvider' => $saleOrderDataProvider
));
?>
