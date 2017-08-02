<?php
//$sale as SaleHeader model

$this->breadcrumbs = array(
    'Subcon Request' => array('/transaction/subconRequest/create'),
    'View',
);
?>

<style>
    table
    {
        margin-bottom: 0px;
    }
</style>

<h1>View Subcon Request</h1>

<?php if (Yii::app()->user->hasFlash('confirm')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('confirm'); ?>
    </div>
<?php endif; ?>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $subconRequest,
    'attributes' => array(
        array(
            'label' => 'Subcon Request #',
            'value' => $subconRequest->getCodeNumber(SubconRequestHeader::CN_CONSTANT),
        ),
        array(
            'label' => 'Tanggal',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", $subconRequest->date),
        ),
        array(
            'label' => 'SO #',
            'type' => 'raw',
            'value' => CHtml::link(CHtml::encode($subconRequest->saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)), array('/transaction/saleOrder/view', 'id' => $subconRequest->sale_order_id), array('target' => 'blank')),
        ),
        array(
            'label' => 'Tanggal SO',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($subconRequest, 'saleOrder.date'))),
        ),
        array(
            'label' => 'Catatan',
            'value' => $subconRequest->note,
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
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Print', array('memo', 'id' => $subconRequest->id), array('target' => '_blank')); ?>

</div>

