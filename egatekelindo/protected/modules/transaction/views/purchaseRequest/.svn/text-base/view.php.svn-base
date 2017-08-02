<?php
//$sale as SaleHeader model

$this->breadcrumbs = array(
    'Purchase Request' => array('create'),
    'View',
);
?>

<style>
    table
    {
        margin-bottom: 0px;
    }
</style>

<h1>View Purchase Request</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $purchaseRequest,
    'attributes' => array(
        array(
            'label' => 'Purchase Request #',
            'value' => $purchaseRequest->getCodeNumber(PurchaseRequestHeader::CN_CONSTANT),
        ),
        array(
            'label' => 'Tanggal',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", $purchaseRequest->date),
        ),
        array(
            'label' => 'Tanggal Kirim',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", $purchaseRequest->delivery_date),
        ),
        array(
            'label' => 'SPK #',
            'value' => (!empty($purchaseRequest->workOrderProductionHeader)) ? $purchaseRequest->workOrderProductionHeader->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT) : 'N/A',
        ),
        array(
            'label' => 'Klien',
            'value' => (!empty($purchaseRequest->workOrderProductionHeader)) ? $purchaseRequest->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->client_company : 'N/A',
        ),
        array(
            'label' => 'SO #',
            'value' => (!empty($purchaseRequest->workOrderProductionHeader)) ? $purchaseRequest->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT) : 'N/A',
        ),
        array(
            'label' => 'Nama Proyek',
            'value' => (!empty($purchaseRequest->workOrderProductionHeader)) ? $purchaseRequest->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->project_name : 'N/A',
        ),
        array(
            'label' => 'Departemen',
            'value' => $purchaseRequest->department->name,
        ),
        array(
            'label' => 'Pekerjaan',
            'value' => $purchaseRequest->job->name,
        ),
        array(
            'label' => 'Tempat',
            'value' => $purchaseRequest->place,
        ),
        array(
            'label' => 'Warna',
            'value' => $purchaseRequest->color,
        ),
        array(
            'label' => 'Catatan',
            'value' => $purchaseRequest->note,
        ),
    ),
));
?>

<?php if ($purchaseRequest->is_service): ?>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'service-detail-grid',
        'dataProvider' => $detailsServiceDataProvider,
        'columns' => array(
            'name: Nama Barang',
            array(
                'header' => 'Quantity',
                'value' => 'number_format($data->quantity, 0)',
                'htmlOptions' => array(
                    'style' => 'text-align: center',
                ),
            ),
            'weight',
            'memo',
        ),
    ));
    ?>
<?php else: ?>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'product-detail-grid',
        'dataProvider' => $detailsProductDataProvider,
        'columns' => array(
            'component.name: Nama Barang',
            'component.componentBrand.name: Brand',
            array(
                'header' => 'Quantity',
                'value' => 'number_format($data->quantity, 0)',
                'htmlOptions' => array(
                    'style' => 'text-align: center',
                ),
            ),
            'weight',
            'memo',
        ),
    ));
    ?>
<?php endif; ?>

<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Print', array('memo', 'id' => $purchaseRequest->id), array('target' => '_blank')); ?>

</div>

