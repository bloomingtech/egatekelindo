<?php
$this->breadcrumbs = array(
    'estimation' => array('/transaction/estimationHeader/create'),
    'view',
);
?>

<h1>
    <?php echo $this->id . '/' . $this->action->id; ?>
</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $estimation,
    'attributes' => array(
        array(
            'label' => 'Estimasi #',
            'value' => CHtml::encode($estimation->getCodeNumber($estimation->cn_initial)),
        ),
        array(
            'label' => 'Revisi #',
            'value' => CHtml::encode($estimation->cn_revision),
        ),
        array(
            'label' => 'Tanggal',
            'value' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', CHtml::value($estimation, 'date'))),
        ),
        array(
            'label' => 'SO #',
            'value' => CHtml::encode($estimation->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)),
        ),
        array(
            'label' => 'Project',
            'value' => CHtml::encode(CHtml::value($estimation, 'project_name')),
        ),
        array(
            'label' => 'Company',
            'value' => CHtml::encode(CHtml::value($estimation, 'client_company')),
        ),
        array(
            'label' => 'Name',
            'value' => CHtml::encode(CHtml::value($estimation, 'client_name')),
        ),
        array(
            'label' => 'Note',
            'value' => CHtml::encode(CHtml::value($estimation, 'note')),
        ),
        array(
            'label' => 'Status',
            'value' => CHtml::encode(CHtml::value($estimation, 'status')),
        ),
    ),
));
?>

<?php
//$this->widget('zii.widgets.grid.CGridView', array(
//    'id' => 'estimation-brand-discount-grid',
//    'dataProvider' => $detailDataProvider,
//    'columns' => array(
//        array(
//            'header' => 'Brand',
//            'value' => 'CHtml::encode(CHtml::value($data,"componentBrandDiscount.componentBrand.name"))'
//        ),
//        array(
//            'header' => 'Value 1',
//            'value' => 'CHtml::encode(CHtml::value($data,"value_1"))'
//        ),
//        array(
//            'header' => 'Value 2',
//            'value' => 'CHtml::encode(CHtml::value($data,"value_2"))'
//        ),
//        array(
//            'header' => 'Value 3',
//            'value' => 'CHtml::encode(CHtml::value($data,"value_3"))'
//        ),
////        array(
////            'header' => 'Value 4',
////            'value' => 'CHtml::encode(CHtml::value($data,"value_4"))'
////        ),
////        array(
////            'header' => 'Value 5',
////            'value' => 'CHtml::encode(CHtml::value($data,"value_5"))'
////        ),
//        array(
//            'header' => 'Currency',
//            'value' => 'CHtml::encode(CHtml::value($data,"estimationCurrency.value"))'
//        ),
//        )));
?>

<?php
//$this->widget('zii.widgets.grid.CGridview', array(
//    'id' => 'estimation-panel-grid',
//    'dataProvider' => $panelDataProvider,
//    'columns' => array(
//        array(
//            'header' => 'Panel',
//            'value' => 'CHtml::encode(CHtml::value($data,"panel_name"))'
//        ),
//        array(
//            'header' => 'Status',
//            'value' => 'CHtml::encode(CHtml::value($data,"status"))'
//        ),
//        )));
?>

<?php
//$this->widget('zii.widgets.grid.CGridView', array(
//    'id' => 'estimation-component-grid',
//    'dataProvider' => $estimationComponentDataProvider,
//    'columns' => array(
//        array(
//            'header' => 'Panel Name',
//            'value' => 'CHtml::encode(CHtml::value($data,"estimationPanel.panel_name"))',
//            'htmlOptions' => array(
//                'style' => 'text-align: center',
//            ),
//        ),
//        array(
//            'header' => 'Komponen',
//            'value' => 'CHtml::encode(CHtml::value($data,"component.name"))'
//        ),
//        array(
//            'header' => 'Quantity',
//            'value' => 'number_format(CHtml::encode(CHtml::value($data, "quantity")), 0)',
//            'htmlOptions' => array(
//                'style' => 'text-align: right',
//            ),
//        ),
//        array(
//            'header' => 'Unit Price',
//            'value' => 'number_format(CHtml::encode(CHtml::value($data, "unit_price")), 2)',
//            'htmlOptions' => array(
//                'style' => 'text-align: right',
//            ),
//        ),
//        array(
//            'header' => 'Basic Price',
//            'value' => 'number_format(CHtml::encode(CHtml::value($data, "basicPriceOnly")), 2)',
//            'htmlOptions' => array(
//                'style' => 'text-align: right',
//            ),
//        ),
//		array(
//            'header' => 'Total',
//            'value' => 'number_format($data->totalOnly, 2)',
//            'htmlOptions' => array(
//                'style' => 'text-align: right',
//            ),
//        ),
//        array(
//            'header' => 'Accessories Phase',
//            'type' => 'RAW',
//            'value' => 'CHtml::encode(CHtml::value($data,"accesoriesPhase.nameFull"))',
//            'htmlOptions' => array(
//                'style' => 'text-align: center',
//            ),
//        ),
//        array(
//            'header' => 'Accessories Value',
//            'value' => 'number_format(CHtml::encode(CHtml::value($data, "accesories_phase_value")), 2)',
//            'htmlOptions' => array(
//                'style' => 'text-align: right',
//            ),
//        ),
//        
//        )));
?>

<?php
//$this->widget('zii.widgets.grid.CGridView', array(
//    'id' => 'estimation-component-accesories-grid',
//    'dataProvider' => $estimationComponentAccesoriesDataProvider,
//    'columns' => array(
//        array(
//            'header' => 'Panel Name',
//            'value' => 'CHtml::encode(CHtml::value($data,"estimationPanel.panel_name"))',
//            'htmlOptions' => array(
//                'style' => 'text-align: center',
//            ),
//        ),
//        array(
//            'header' => 'Accesories',
//            'value' => '$data->component_id ? CHtml::encode(CHtml::value($data,"component.name")) : CHtml::encode(CHtml::value($data,"componentCu.name"))'
//        ),
//        array(
//            'header' => 'Weight',
//            'value' => 'number_format(CHtml::encode(CHtml::value($data, "weight")), 0)',
//            'htmlOptions' => array(
//                'style' => 'text-align: right',
//            ),
//        ),
//        array(
//            'header' => 'Quantity',
//            'value' => 'number_format(CHtml::encode(CHtml::value($data, "quantity")), 0)',
//            'htmlOptions' => array(
//                'style' => 'text-align: right',
//            ),
//        ),
//        array(
//            'header' => 'Unit Price',
//            'value' => 'number_format(CHtml::encode(CHtml::value($data, "unit_price")), 2)',
//            'htmlOptions' => array(
//                'style' => 'text-align: right',
//            ),
//        ),
//        array(
//            'header' => 'Basic Price',
//            'value' => 'number_format(CHtml::encode(CHtml::value($data, "basicPriceOnly")), 2)',
//            'htmlOptions' => array(
//                'style' => 'text-align: right',
//            ),
//        ),
//        array(
//            'header' => 'Accessories Phase',
//            'type' => 'RAW',
//            'value' => 'CHtml::encode(CHtml::value($data,"accesoriesPhase.nameFull"))',
//            'htmlOptions' => array(
//                'style' => 'text-align: center',
//            ),
//        ),
//        array(
//            'header' => 'Accessories Value',
//            'value' => 'number_format(CHtml::encode(CHtml::value($data, "accesories_phase_value")), 2)',
//            'htmlOptions' => array(
//                'style' => 'text-align: right',
//            ),
//        ),
//        array(
//            'header' => 'Total',
//            'value' => 'number_format($data->totalOnly, 2)',
//            'htmlOptions' => array(
//                'style' => 'text-align: right',
//            ),
//        ),
//        )));
?>
<br/>

<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th>Panel Name</th>
        <th colspan="4">&nbsp;</th>
    </tr>
    <?php
    $panels = $estimation->estimationPanels;
    if (count($estimation->estimationPanels) > 0) :
        usort($panels, function ($a, $b) {
			if ($a['sort_number'] == $b['sort_number'])
				return 0;
			return ($a['sort_number'] < $b['sort_number']) ? -1 : 1;
		});
	?>
        <?php foreach ($panels as $panel): ?>
            <tr>
                <td><?php echo CHtml::encode(CHtml::value($panel, 'panel_name')); ?></td>
                <td style="width: 10%">
                    <div id="link">
                        <?php echo CHtml::link('View', array('viewDetail', 'id' => $panel->id, 'headerId' => $estimation->id)); ?>
                    </div>
                </td>
				<td style="width: 10%">
					<?php if (empty($panel->estimationComponents)): ?>
						<div id="link">
							<?php echo CHtml::link('Upload Komponen', array('uploadDetail', 'id' => $panel->id, 'headerId' => $estimation->id)); ?>
						</div>
					<?php endif; ?>
				</td>
				<td style="width: 10%">
					<?php if (empty($panel->estimationComponentAccesories)): ?>
						<div id="link">
							<?php echo CHtml::link('Upload CU', array('uploadDetailAccesories', 'id' => $panel->id, 'headerId' => $estimation->id)); ?>
						</div>
					<?php endif; ?>
				</td>
				<td style="width: 15%">
					<div id="link">
						<?php echo CHtml::link('Delete Komponen + CU', array('delete', 'id' => $panel->id)); ?>
					</div>
				</td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>




<div id="link">
    <?php echo CHtml::link('Create', array('saleOrderList')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php //echo CHtml::link('Print', array('memo', 'id' => $estimation->id), array('target' => '_blank')); ?>
    <?php //echo CHtml::link('Tambah Panel', array('addPanel', 'id' => $estimation->id)); ?>
</div>
