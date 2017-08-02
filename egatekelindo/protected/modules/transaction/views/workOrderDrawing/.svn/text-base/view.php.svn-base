<?php
$this->breadcrumbs = array(
    'WorkOrderProduction' => array('/transaction/workOrderProduction/create'),
    'View',
);
?>
<?php if (Yii::app()->user->hasFlash('confirm')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('confirm'); ?>
    </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
<h1><?php echo 'SPK Gambar/' . $this->action->id; ?></h1>
<div id="detail_div">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $workOrderDrawing,
        'attributes' => array(
            array(
                'label' => 'SPK #',
                'value' => $workOrderDrawing->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT),
            ),
            array(
                'label' => 'Tanggal',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($workOrderDrawing, 'date'))),
            ),
            array(
                'label' => 'SO #',
                'type' => 'raw',
                'value' => CHtml::link(CHtml::encode($workOrderDrawing->budgetingHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)), array('/transaction/saleOrder/view', 'id' => $workOrderDrawing->budgetingHeader->sale_order_header_id), array('target' => 'blank')),
            ),
            array(
                'label' => 'Client Company',
                'value' => CHtml::encode(CHtml::value($workOrderDrawing->budgetingHeader->saleOrderHeader, 'client_company')),
            ),
            array(
                'label' => 'Project Name',
                'value' => CHtml::encode(CHtml::value($workOrderDrawing->budgetingHeader->saleOrderHeader, 'project_name')),
            ),
            array(
                'label' => 'Budgeting #',
                'type' => 'raw',
                'value' => CHtml::link(CHtml::encode($workOrderDrawing->budgetingHeader->getCodeNumber(BudgetingHeader::CN_CONSTANT)), array('/transaction/budgeting/view', 'id' => $workOrderDrawing->budgeting_header_id), array('target' => 'blank')),
            ),
            array(
                'label' => 'Tanggal Budgeting',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($workOrderDrawing, 'budgetingHeader.date'))),
            ),
            array(
                'label' => 'Gambar Layout',
                'value' => ($workOrderDrawing->is_drawing_layout_attached == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Spesifikasi Tehnis',
                'value' => ($workOrderDrawing->is_technical_specification_attached == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Single Line Diagram',
                'value' => ($workOrderDrawing->is_single_line_diagram_attached == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Break Down Component',
                'value' => ($workOrderDrawing->is_break_down_component_attached == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Gambar Konstruksi',
                'value' => ($workOrderDrawing->is_construction_layout == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Front & Side View',
                'value' => ($workOrderDrawing->is_front_side_view == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Section',
                'value' => ($workOrderDrawing->is_section == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Gambar Kontrol',
                'value' => ($workOrderDrawing->is_control_layout == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Komponent List',
                'value' => ($workOrderDrawing->is_component_list == 1) ? 'Yes' : 'No',
            ),
            array(
                'label' => 'Catatan',
                'value' => $workOrderDrawing->note,
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
                'value' => '$data->saleOrderDetail->panel_name'
            ),
            array(
                'header' => 'Gambar Selesai',
                'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($data, "finish_date")))',
                'htmlOptions' => array(
                    'style' => 'text-align: center',
                ),
            ),
            'memo',
            array(
                'header' => 'Proposal',
                'type' => 'raw',
                'value' => 'CHtml::link("Add", array("workOrderDrawingProposal/add", "detailId"=>$data->id, "headerId"=>$data->work_order_drawing_header_id))."  " .CHtml::link("View", array("workOrderDrawingProposal/view", "detailId"=>$data->id, "headerId"=>$data->work_order_drawing_header_id))',
                'htmlOptions' => array(
                    'style' => 'text-align: center',
                ),
            ),
            array(
                'header' => 'Revision',
                'type' => 'raw',
                'value' => 'CHtml::link("Add", array("workOrderDrawingRevision/add", "detailId"=>$data->id, "headerId"=>$data->work_order_drawing_header_id))."  " .CHtml::link("View", array("workOrderDrawingRevision/view", "detailId"=>$data->id, "headerId"=>$data->work_order_drawing_header_id))',
                'htmlOptions' => array(
                    'style' => 'text-align: center',
                ),
            ),
        ),
    ));
    ?>

    <div id="link">
        <?php echo CHtml::link('Create', array('budgetingList')); ?>
        <?php echo CHtml::link('Manage', array('admin')); ?>
        <?php echo CHtml::link('Print', array('memo', 'id' => $workOrderDrawing->id), array('target' => '_blank')); ?>
    </div>

</div>

<br/>
<div>
    <?php if ((int) $workOrderDrawing->is_confirmed === 0): ?>
        <div>
            <?php echo CHtml::beginForm(); ?>
            <?php echo CHtml::submitButton('Confirm', array('name' => 'Confirm', 'class' => 'btn-approve')); ?>
            <?php echo CHtml::endForm(); ?>
        </div>
    <?php endif; ?>
</div>