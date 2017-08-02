<?php
$this->breadcrumbs = array(
    'Delivery' => array('/transaction/delivery/create'),
    'View',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<div id="detail_div">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $delivery,
        'attributes' => array(
            array(
                'label' => 'Pengiriman #',
                'value' => $delivery->getCodeNumber(DeliveryHeader::CN_CONSTANT),
            ),
            array(
                'label' => 'Tanggal',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($delivery, 'date'))),
            ),
            array(
                'label' => 'SO #',
                'type' => 'raw',
                'value' => CHtml::link(CHtml::encode($delivery->saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)), array('/transaction/saleOrder/view', 'id' => $delivery->sale_order_id), array('target' => 'blank')),
            ),
            array(
                'label' => 'Tanggal SO',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($delivery, 'saleOrder.date'))),
            ),
        ),
    ));
    ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'delivery-detail-grid',
        'dataProvider' => $detailsDataProvider,
        'columns' => array(
            'panel_name: Nama Panel',
            'unit.name: Satuan',
            array(
                'header' => 'Qty Kirim',
                'value' => 'number_format(CHtml::encode(CHtml::value($data, "quantity")), 0)',
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
        <?php echo CHtml::link('Print', array('memo', 'id' => $delivery->id), array('target' => '_blank')); ?>
    </div>
</div>