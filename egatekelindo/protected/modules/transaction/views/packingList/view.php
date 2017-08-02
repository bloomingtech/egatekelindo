<?php
$this->breadcrumbs = array(
    'Packing List' => array('/transaction/pickingList/create'),
    'View',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<div id="detail_div">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $packingList,
        'attributes' => array(
            array(
                'label' => 'Packing List #',
                'value' => $packingList->getCodeNumber(PackingListHeader::CN_CONSTANT),
            ),
            array(
                'label' => 'Tanggal',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($packingList, 'date'))),
            ),
            array(
                'label' => 'Part List #',
                'type' => 'raw',
                'value' => CHtml::link(CHtml::encode($packingList->partListHeader->getCodeNumber(PartListHeader::CN_CONSTANT)), array('/transaction/partList/view', 'id' => $packingList->part_list_header_id), array('target' => 'blank')),
            ),
            array(
                'label' => 'Tanggal Part List',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($packingList, 'partListHeader.date'))),
            ),
            array(
                'label' => 'Catatan',
                'value' => $packingList->note,
            ),
        ),
    ));
    ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'delivery-detail-grid',
        'dataProvider' => $detailsDataProvider,
        'columns' => array(
            'partListDetail.component.name: Nama Panel',
            'partListDetail.component.componentBrand.name: Brand',
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
        <?php echo CHtml::link('Print', array('memo', 'id' => $packingList->id), array('target' => '_blank')); ?>
    </div>
</div>