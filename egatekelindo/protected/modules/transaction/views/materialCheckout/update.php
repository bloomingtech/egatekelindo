<?php
$this->breadcrumbs = array(
    'Material Checkout' => array('admin'),
    'Create',
);
?>

<h1>Revisi Material Checkout</h1>

<?php
echo $this->renderPartial('_form', array(
    'materialCheckout' => $materialCheckout,
    'packingListHeader' => $packingListHeader,
    'packingListHeaderDataProvider' => $packingListHeaderDataProvider,
));