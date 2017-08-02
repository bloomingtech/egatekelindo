<?php
$this->breadcrumbs = array(
    'Part List' => array('/transaction/pastList/create'),
    'View',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<div id="detail_div">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $partList,
        'attributes' => array(
            array(
                'label' => 'Part List #',
                'value' => $partList->getCodeNumber(PartListHeader::CN_CONSTANT),
            ),
            array(
                'label' => 'Tanggal',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($partList, 'date'))),
            ),
            array(
                'label' => 'SO #',
                'type' => 'raw',
                'value' => CHtml::link(CHtml::encode($partList->saleOrder->getNumber(SaleOrder::CN_CONSTANT)), array('/transaction/saleOrder/view', 'id' => $partList->sale_order_id), array('target' => 'blank')),
            ),
            array(
                'label' => 'Tanggal SO',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($partList, 'saleOrder.date'))),
            ),
            array(
                'label' => 'Catatan',
                'value' => $partList->note,
            ),
        ),
    ));
    ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'delivery-detail-grid',
        'dataProvider' => $detailsDataProvider,
        'columns' => array(
            'component.name: Nama',
            'component.componentBrand.name: Brand',
            array(
                'header' => 'Qty',
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
        <?php echo CHtml::link('Print', array('memo', 'id' => $partList->id), array('target' => '_blank')); ?>
    </div>
</div>