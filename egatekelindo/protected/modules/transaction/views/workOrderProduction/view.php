<?php
$this->breadcrumbs = array(
    'WorkOrderProduction' => array('/transaction/workOrderProduction/create'),
    'View',
);
?>
<h1><?php 'SPK Produksi/' . $this->action->id; ?></h1>
<div id="detail_div">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $workOrderProduction,
        'attributes' => array(
            array(
                'label' => 'SPK #',
                'value' => $workOrderProduction->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT),
            ),
            array(
                'label' => 'Tanggal',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($workOrderProduction, 'date'))),
            ),
            array(
                'label' => 'SO #',
                'type' => 'raw',
                'value' => CHtml::link(CHtml::encode($workOrderProduction->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)), array('/transaction/saleOrder/view', 'id' => $workOrderProduction->workOrderDrawingHeader->budgetingHeader->sale_order_header_id), array('target' => 'blank')),
            ),
            array(
                'label' => 'Client Company',
                'value' => CHtml::encode(CHtml::value($workOrderProduction->workOrderDrawingHeader->budgetingHeader->saleOrderHeader, 'client_company')),
            ),
            array(
                'label' => 'Project Name',
                'value' => CHtml::encode(CHtml::value($workOrderProduction->workOrderDrawingHeader->budgetingHeader->saleOrderHeader, 'project_name')),
            ),
            array(
                'label' => 'SPK Gambar #',
                'type' => 'raw',
                'value' => CHtml::link(CHtml::encode($workOrderProduction->workOrderDrawingHeader->getCodeNumber(WorkOrderDrawingHeader::CN_CONSTANT)), array('/transaction/workOrderDrawing/view', 'id' => $workOrderProduction->work_order_drawing_header_id), array('target' => 'blank')),
            ),
            array(
                'label' => 'Tanggal SPK',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($workOrderProduction, 'workOrderDrawingHeader.date'))),
            ),
            array(
                'label' => 'Gambar Konstruksi',
                'value' => ($workOrderProduction->is_construction_drawing == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Gambar Section',
                'value' => ($workOrderProduction->is_section_drawing == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Gambar Single Line',
                'value' => ($workOrderProduction->is_single_line_drawing == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Gambar Kontrol',
                'value' => ($workOrderProduction->is_control_drawing == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'List Komponen',
                'value' => ($workOrderProduction->is_component_listed == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Urgent',
                'value' => ($workOrderProduction->is_urgent == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Cat Grey',
                'value' => ($workOrderProduction->is_grey_painted == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Cat Light Grey',
                'value' => ($workOrderProduction->is_light_grey_painted == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Cat Cream',
                'value' => ($workOrderProduction->is_cream_painted == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Catatan',
                'value' => $workOrderProduction->note,
            ),
        ),
    ));
    ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'delivery-detail-grid',
        'dataProvider' => $detailsDataProvider,
        'columns' => array(
            array(
                'header' => 'Nama Panel',
                'value' => '$data->workOrderDrawingDetail->saleOrderDetail->panel_name'
            ),
            'panel_dimension: Dimensi Panel',
            array(
                'header' => 'Qty Kirim',
                'value' => 'number_format(CHtml::encode(CHtml::value($data, "quantity")), 0)',
                'htmlOptions' => array(
                    'style' => 'text-align: right',
                ),
            ),
            array(
                'header' => 'Panel Delivery',
                'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($data, "delivery_date")))',
                'htmlOptions' => array(
                    'style' => 'text-align: center',
                ),
            ),
            'memo',
        ),
    ));
    ?>

    <div id="link">
        <?php echo CHtml::link('Create', array('workOrderDrawingList')); ?>
        <?php echo CHtml::link('Manage', array('admin')); ?>
        <?php echo CHtml::link('Print', array('memo', 'id' => $workOrderProduction->id), array('target' => '_blank')); ?>
    </div>
</div>