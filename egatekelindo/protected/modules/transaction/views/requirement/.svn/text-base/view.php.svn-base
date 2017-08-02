<?php
$this->breadcrumbs = array(
    'Requirement' => array('/transaction/requirement/create'),
    'View',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<div id="detail_div">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $requirement,
        'attributes' => array(
            array(
                'label' => 'Requirement #',
                'value' => $requirement->getCodeNumber($requirement->cnConstant),
            ),
            array(
                'label' => 'Tanggal',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($requirement, 'date'))),
            ),
            array(
                'label' => 'SPK Produksi #',
                'type' => 'raw',
                'value' => CHtml::link(CHtml::encode($requirement->workOrderProductionHeader->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT)), array('/transaction/workOrderProductionHeader/view', 'id' => $requirement->work_order_production_header_id), array('target' => 'blank')),
            ),
            array(
                'label' => 'Tanggal SPK',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($requirement, 'workOrderProductionHeader.date'))),
            ),
            array(
                'label' => 'SO #',
                'type' => 'raw',
                'value' => CHtml::link(CHtml::encode($requirement->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)), array('/transaction/saleOrder/view', 'id' => $requirement->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->sale_order_header_id), array('target' => 'blank')),
            ),
            array(
                'label' => 'Client Company',
                'value' => CHtml::encode(CHtml::value($requirement->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader, 'client_company')),
            ),
            array(
                'label' => 'Project Name',
                'value' => CHtml::encode(CHtml::value($requirement->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader, 'project_name')),
            ),
            array(
                'label' => 'Catatan',
                'value' => $requirement->note,
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
                'header' => 'Qty',
                'value' => 'number_format(CHtml::encode(CHtml::value($data, "quantity")), 0)',
                'htmlOptions' => array(
                    'style' => 'text-align: right',
                ),
            ),
            array(
                'header' => 'Unit Price',
                'value' => 'number_format(CHtml::encode(CHtml::value($data, "unit_price")), 0)',
                'htmlOptions' => array(
                    'style' => 'text-align: right',
                ),
            ),
            array(
                'header' => 'Total',
                'value' => 'number_format(CHtml::encode(CHtml::value($data, "total")), 0)',
                'htmlOptions' => array(
                    'style' => 'text-align: right',
                ),
            ),
            array(
                'header' => 'View',
                'type' => 'raw',
                'value' => 'CHtml::link("View", array("requirementDetail/view", "id"=>$data->id, "headerId"=>$data->requirement_header_id))',
                'htmlOptions' => array(
                    'style' => 'text-align: center',
                ),
            ),
            array(
                'header' => 'Update',
                'type' => 'raw',
                'value' => 'CHtml::link("Update", array("requirementDetail/update", "id"=>$data->id, "headerId"=>$data->requirement_header_id))',
                'htmlOptions' => array(
                    'style' => 'text-align: center',
                ),
            ),
        ),
    ));
    ?>
    <table>
        <tr style="background-color: aquamarine">
            <td style="font-weight: bold; text-align: right;width: 60%">Sub Total</td>
            <td style="font-weight: bold; text-align: right;">
                <span id="sub_total">
                    <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($requirement, 'subTotal'))); ?>
                </span>
            </td>
            <td style="font-weight: bold; text-align: right;width: 25%"></td>
        </tr>
    </table>
    <div id="link">
        <?php echo CHtml::link('Create', array('workOrderProductionList')); ?>
        <?php echo CHtml::link('Manage', array('admin')); ?>

        <?php if ($requirement->is_component) : ?>
            <?php echo CHtml::link('Print Component', array('memoComponent', 'id' => $requirement->id), array('target' => '_blank')); ?>
        <?php else : ?>
            <?php echo CHtml::link('Print Cu', array('memoCu', 'id' => $requirement->id), array('target' => '_blank')); ?>
        <?php endif; ?>
    </div>
</div>