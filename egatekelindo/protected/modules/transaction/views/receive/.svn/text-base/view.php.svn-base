<?php
//$sale as SaleHeader model

$this->breadcrumbs = array(
    'Receive' => array('purchaseList'),
    'View',
);
?>

<style>
    table
    {
        margin-bottom: 0px;
    }
</style>

<h1>View Penerimaan</h1>

<?php if (Yii::app()->user->hasFlash('confirm')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('confirm'); ?>
    </div>
<?php endif; ?>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $receive,
    'attributes' => array(
        array(
            'label' => 'Penerimaan #',
            'value' => $receive->getCodeNumber(ReceiveHeader::CN_CONSTANT),
        ),
        array(
            'label' => 'Tanggal',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", $receive->date),
        ),
        array(
            'label' => 'Gudang',
            'value' => $receive->warehouse->name,
        ),
        array(
            'label' => 'PO #',
            'value' => $receive->purchaseHeader->getCodeNumber(PurchaseHeader::CN_CONSTANT),
        ),
        array(
            'label' => 'Tanggal PO',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", $receive->purchaseHeader->date),
        ),
        array(
            'label' => 'Supplier',
            'value' => $receive->purchaseHeader->supplier->company,
        ),
        array(
            'label' => 'SO #',
            'value' => ($receive->purchaseHeader->saleOrderHeader != null) ? CHtml::encode($receive->purchaseHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)) : 'N/A',
        ),
        array(
            'label' => 'Client',
            'value' => ($receive->purchaseHeader->saleOrderHeader != null) ? CHtml::encode($receive->purchaseHeader->saleOrderHeader->client_company) : 'N/A',
        ),
        array(
            'label' => 'Project',
            'value' => ($receive->purchaseHeader != null) ? CHtml::encode($receive->purchaseHeader->project_name) : 'N/A',
        ),
        array(
            'label' => 'Catatan',
            'value' => $receive->note,
        ),
    ),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'sale-detail-grid',
    'dataProvider' => $detailsDataProvider,
    'columns' => array(
        'component.name: Nama Barang',
        'component.componentBrand.name: Brand',
        array(
            'header' => 'Qty',
            'value' => 'number_format($data->quantity, 0)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
    ),
));
?>

<div id="link">
    <?php echo CHtml::link('Create', array('purchaseList')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php //echo CHtml::link('Print', array('memo', 'id' => $receive->id), array('target' => '_blank')); ?>
</div>

