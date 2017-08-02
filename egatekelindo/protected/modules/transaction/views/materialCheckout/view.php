<?php
$this->breadcrumbs = array(
    'Material Checkout' => array('/transaction/pickingList/create'),
    'View',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<div id="detail_div">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $materialCheckout,
        'attributes' => array(
            array(
                'label' => 'Packing List #',
                'value' => $materialCheckout->getCodeNumber(MaterialCheckoutHeader::CN_CONSTANT),
            ),
            array(
                'label' => 'Tanggal',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($materialCheckout, 'date'))),
            ),
            array(
                'label' => 'Packing List #',
                'type' => 'raw',
                'value' => CHtml::link(CHtml::encode($materialCheckout->packingListHeader->getCodeNumber(PackingListHeader::CN_CONSTANT)), array('/transaction/packingList/view', 'id' => $materialCheckout->packing_list_header_id), array('target' => 'blank')),
            ),
            array(
                'label' => 'Tanggal Packing',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($materialCheckout, 'packingListHeader.date'))),
            ),
            array(
                'label' => 'Catatan',
                'value' => $materialCheckout->note,
            ),
        ),
    ));
    ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'delivery-detail-grid',
        'dataProvider' => $detailsDataProvider,
        'columns' => array(
            'packingListDetail.partListDetail.component.name: Nama',
            'packingListDetail.partListDetail.component.componentBrand.name: Brand',
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
        <?php echo CHtml::link('Print', array('memo', 'id' => $materialCheckout->id), array('target' => '_blank')); ?>
    </div>
</div>