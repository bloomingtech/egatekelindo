<?php
$this->breadcrumbs = array(
    'Kerja Tambah' => array('/transaction/requirementAssurance/admin'),
    'View',
);
?>
<h1><?php echo 'Kerja Tambah /' . $this->action->id; ?></h1>
<div id="detail_div">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $requirementAssurance,
        'attributes' => array(
            array(
                'label' => 'Kerja Tambah #',
                'value' => $requirementAssurance->getCodeNumber(RequirementAssuranceHeader::CN_CONSTANT),
            ),
            array(
                'label' => 'Tanggal',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($requirementAssurance, 'date'))),
            ),
            array(
                'label' => 'SPK Produksi #',
                'type' => 'raw',
                'value' => CHtml::encode($requirementAssurance->requirementHeader->workOrderProductionHeader->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT)),
            ),
            array(
                'label' => 'Tanggal SPK',
                'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($requirementAssurance, 'requirementHeader.workOrderProductionHeader.date'))),
            ),
            array(
                'label' => 'SO #',
                'type' => 'raw',
                'value' => CHtml::encode($requirementAssurance->requirementHeader->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)),
            ),
            array(
                'label' => 'Client Company',
                'value' => CHtml::encode(CHtml::value($requirementAssurance->requirementHeader->saleOrderHeader, 'client_company')),
            ),
            array(
                'label' => 'Project Name',
                'value' => CHtml::encode(CHtml::value($requirementAssurance->requirementHeader->saleOrderHeader, 'project_name')),
            ),
            array(
                'label' => 'Catatan',
                'value' => $requirementAssurance->note,
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
                'value' => '$data->requirementDetail->saleOrderDetail->panel_name'
            ),
            array(
                'header' => 'Qty',
                'value' => 'number_format(CHtml::encode(CHtml::value($data, "quantity")), 0)',
                'htmlOptions' => array(
                    'style' => 'text-align: center',
                ),
            ),
			'wiring_name',
			array(
                'header' => 'Wiring Value',
                'value' => 'number_format(CHtml::encode(CHtml::value($data, "wiring_value")), 0)',
                'htmlOptions' => array(
                    'style' => 'text-align: right',
                ),
            ),
            array(
                'header' => 'View',
                'type' => 'raw',
                'value' => 'CHtml::link("View", array("requirementAssurancePanelComponent/view", "id"=>$data->id))',
                'htmlOptions' => array(
                    'style' => 'text-align: center',
                ),
            ),
            array(
                'header' => 'Create',
                'type' => 'raw',
                'value' => 'CHtml::link("Create", array("requirementAssurancePanelComponent/create", "requirementAssuranceDetailPanelId" => $data->id))',
                'htmlOptions' => array(
                    'style' => 'text-align: center',
                ),
            ),
        ),
    ));
    ?>
	
<br/>

<table>
    <tr id="theader">
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;">Brand</th>
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;text-align: right;">Value 1</th>
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;text-align: right;">Type 1</th>
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;text-align: right;">Value 2</th>
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;text-align: right;">Type 2</th>
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;text-align: right;">Value 3</th>
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;text-align: right;">Type 3</th>
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;text-align: right;">Value 4</th>
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;text-align: right;">Type 4</th>
    </tr>
    <?php
    $requirementAssuranceBrandDiscounts = $requirementAssurance->requirementAssuranceBrandDiscounts;

    foreach ($requirementAssuranceBrandDiscounts as $i => $requirementAssuranceBrandDiscount)
        $requirementAssuranceBrandDiscounts[$i]->isPrimary = $requirementAssuranceBrandDiscount->componentBrandDiscount->is_primary;

    usort($requirementAssuranceBrandDiscounts, function ($a, $b) {
		if ($a['isPrimary'] == $b['isPrimary'])
			return 0;
		return ($a['isPrimary'] < $b['isPrimary']) ? 1 : -1;
	});
    ?>
    <?php $currentIsPrimary = NULL; ?>
    <?php foreach ($requirementAssuranceBrandDiscounts as $requirementAssuranceBrandDiscount): ?>
        <?php if ($requirementAssuranceBrandDiscount->isPrimary != $currentIsPrimary && $currentIsPrimary != NULL) : ?>
            <tr>
                <td colspan="10">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="10" style="border-bottom: 1px solid;font-weight: bold;">Komponen Pendukung</td>
            </tr>
        <?php endif; ?>
        <?php if ($currentIsPrimary == NULL): ?>
            <tr>
                <td colspan="10" style="border-bottom: 1px solid;font-weight: bold;">Komponen Utama</td>
            </tr>
        <?php endif; ?>
        <tr>
            <td><?php echo CHtml::encode(CHtml::value($requirementAssuranceBrandDiscount, 'componentBrandDiscount.componentBrand.name')); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($requirementAssuranceBrandDiscount, 'value_1')); ?></td>
            <td style="text-align: right"><?php echo $requirementAssuranceBrandDiscount->getTypeString($requirementAssuranceBrandDiscount->value_calculation_type_1); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($requirementAssuranceBrandDiscount, 'value_2')); ?></td>
            <td style="text-align: right"><?php echo $requirementAssuranceBrandDiscount->getTypeString($requirementAssuranceBrandDiscount->value_calculation_type_2); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($requirementAssuranceBrandDiscount, 'value_3')); ?></td>
            <td style="text-align: right"><?php echo $requirementAssuranceBrandDiscount->getTypeString($requirementAssuranceBrandDiscount->value_calculation_type_3); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($requirementAssuranceBrandDiscount, 'value_4')); ?></td>
            <td style="text-align: right"><?php echo $requirementAssuranceBrandDiscount->getTypeString($requirementAssuranceBrandDiscount->value_calculation_type_4); ?></td>
        </tr>
        <?php $currentIsPrimary = $requirementAssuranceBrandDiscount->isPrimary; ?>
    <?php endforeach; ?>
</table>

<!--    <table>
        <tr style="background-color: aquamarine">
            <td style="font-weight: bold; text-align: right;width: 60%">Sub Total</td>
            <td style="font-weight: bold; text-align: right;">
                <span id="sub_total">
                    <?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($requirementAssurance, 'subTotal'))); ?>
                </span>
            </td>
            <td style="font-weight: bold; text-align: right;width: 25%"></td>
        </tr>
    </table>-->
    <div id="link">
        <?php echo CHtml::link('Create', array('workOrderProductionList')); ?>
        <?php echo CHtml::link('Manage', array('admin')); ?>
        <?php echo CHtml::link('Print', array('memoAll', 'id' => $requirementAssurance->id), array('target' => '_blank')); ?>
 

        <?php /*if ($requirementAssurance->is_component) : ?>
            <?php echo CHtml::link('Print Component', array('memoComponent', 'id' => $requirementAssurance->id), array('target' => '_blank')); ?>
        <?php else : ?>
            <?php echo CHtml::link('Print Cu', array('memoCu', 'id' => $requirementAssurance->id), array('target' => '_blank')); ?>
        <?php endif; */?>
    </div>
</div>