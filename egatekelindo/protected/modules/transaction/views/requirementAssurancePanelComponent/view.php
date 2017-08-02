<?php
$this->breadcrumbs = array(
    'kerja tambah',
    'view',
);
?>
<?php

Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/transaction/memo.css');
Yii::app()->clientScript->registerCss('memo', '
    
    .div-50 {width:50%; float:left}
    
    .table-border {border-collapse:collapse}
    
    table, tr, td, th {border:1px solid}
    th {text-align:center;}
');
?>

<h1>
    <?php echo $this->id . '/' . $this->action->id; ?>
</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $requirementAssurancePanelComponent,
    'attributes' => array(
        array(
            'label' => 'SO #',
            'value' => CHtml::encode($requirementAssurancePanelComponent->requirementAssuranceHeader->requirementHeader->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)),
        ),
        array(
            'label' => 'Tanggal',
            'value' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', CHtml::value($requirementAssurancePanelComponent, 'requirementAssuranceHeader.requirementHeader.saleOrderHeader.date'))),
        ),
        array(
            'label' => 'Project',
            'value' => CHtml::encode(CHtml::value($requirementAssurancePanelComponent, 'requirementAssuranceHeader.requirementHeader.saleOrderHeader.project_name'))
        ),
		array(
            'label' => 'Client',
            'value' => CHtml::encode(CHtml::value($requirementAssurancePanelComponent, 'requirementAssuranceHeader.requirementHeader.saleOrderHeader.client_name'))
        ),
    ),
));
?>

<br/>
<h3>Panel Name : <?php echo $requirementAssurancePanelComponent->requirementDetail->saleOrderDetail->panel_name; ?></h3>
<div class="div-50">
	<table class="table-border">
		<tr>
			<th colspan="5">SPESIFIKASI LAMA</th>
		</tr>
		<tr>
			<th>Nama Komponen</th>
			<th>Type</th>
			<th>Merk</th>
			<th>Qty</th>
			<th>Price</th>

		</tr>
		<?php foreach ($estimationPanel->estimationComponents as $i => $component): ?>
			<tr>
				<td><?php echo CHtml::encode(CHtml::value($component, 'name')); ?></td>
				<td><?php echo CHtml::encode(CHtml::value($component, 'type')); ?></td>
				<td><?php echo CHtml::encode(CHtml::value($component, 'brand.name')); ?></td>
				<td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($component, 'quantity'))); ?></td>
				<td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($component, 'unit_price'))); ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>

<div class="div-50">
	<table class="table-border">
		<tr>
			<th colspan="6">SPESIFIKASI BARU</th>
		</tr>
		<tr >
			<th>Nama Komponen</th>
			<th>Type</th>
			<th>Brand</th>
			<th>Qty</th>
			<th>Price</th>
			<th>Faktor Pengali</th>
		</tr>
		<?php foreach ($detailsDataProvider->data as $detail) : ?>
			<?php if ($detail->is_inactive == 0): ?>
				<tr>
					<td><?php echo CHtml::encode(CHtml::value($detail, 'requirementDetailComponent.component_name')); ?></td>
					<td style="text-align: center;">
						<?php echo CHtml::encode(CHtml::value($detail, 'requirementDetailComponent.budgetingDetail.type')); ?>
					</td>

					<td style="text-align: center;">
						<?php echo CHtml::encode(CHtml::value($detail, 'requirementDetailComponent.budgetingDetail.brand_name')); ?>
					</td>

					<td style="text-align: center;">
						<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?>
					</td>

					<td style="text-align: right;">
						<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'unitPriceAfterDiscount'))); ?>
					</td>

					<td style="text-align: center;">
						<?php echo CHtml::encode(CHtml::value($detail, 'requirementAssuranceBrandDiscount.componentBrandDiscount.componentBrand.name')); ?>
					</td>
				</tr>
			<?php endif; ?>
		<?php endforeach; ?>
	</table>
</div>
<br/>
<div id="link">
    <?php echo CHtml::link('Back', array('requirementAssurance/view', 'id' => $requirementAssurancePanelComponent->requirement_assurance_header_id)); ?>
</div>
