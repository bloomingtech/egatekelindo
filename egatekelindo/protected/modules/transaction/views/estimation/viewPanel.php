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
            'label' => 'Tanggal',
            'value' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', CHtml::value($estimation, 'date'))),
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


<table>
    <tr id="theader">
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;">Brand</th>
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;text-align: right;">Value 1</th>
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;text-align: right;">Value 2</th>
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;text-align: right;">Value 3</th>
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;text-align: right;">Currency</th>
    </tr>
    <?php
    $estimationDetails = $estimation->estimationBrandDiscounts;

    foreach ($estimationDetails as $i => $detail)
        $estimationDetails[$i]->isPrimary = $detail->componentBrandDiscount->is_primary;

    usort($estimationDetails, function ($a, $b) {
                if ($a['isPrimary'] == $b['isPrimary'])
                    return 0;
                return ($a['isPrimary'] < $b['isPrimary']) ? 1 : -1;
            });
    ?>
    <?php $currentIsPrimary = NULL; ?>
    <?php foreach ($estimationDetails as $detail): ?>
        <?php if ($detail->isPrimary != $currentIsPrimary && $currentIsPrimary != NULL) : ?>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5" style="border-bottom: 1px solid;font-weight: bold;">Komponen Pendukung</td>
            </tr>
        <?php endif; ?>
        <?php if ($currentIsPrimary == NULL): ?>
            <tr>
                <td colspan="5" style="border-bottom: 1px solid;font-weight: bold;">Komponen Utama</td>
            </tr>
        <?php endif; ?>
        <tr>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'name')); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'value_1')); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'value_2')); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'value_3')); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'estimationCurrency.value')); ?></td>

        </tr>
        <?php $currentIsPrimary = $detail->isPrimary; ?>
    <?php endforeach; ?>
</table>



<br/>
<table class="memo">
    <tr id="theader">
        <th style="border-top:2px solid; border-bottom: 2px solid;">Panel Name</th>
        <th style="text-align: center;border-top:2px solid; border-bottom: 2px solid;">Name</th>
        <th style="text-align: center;border-top:2px solid; border-bottom: 2px solid;">Brand</th>
        <th style="text-align: center;border-top:2px solid; border-bottom: 2px solid;">Type</th>
        <th style="text-align: center;border-top:2px solid; border-bottom: 2px solid;">Weight</th>
        <th style="text-align: center;border-top:2px solid; border-bottom: 2px solid;">Quantity</th>
        <th style="text-align: center;border-top:2px solid; border-bottom: 2px solid;">Unit Price</th>
        <th style="text-align: center;border-top:2px solid; border-bottom: 2px solid;">Basic Price</th>
        <th style="text-align: center;border-top:2px solid; border-bottom: 2px solid;">Total</th>
        <th style="text-align: center;border-top:2px solid; border-bottom: 2px solid;">Accesories Phase</th>
<!--        <th style="text-align: center;border-top:2px solid; border-bottom: 2px solid;">Accesories Value</th>-->

    </tr>

    <?php foreach ($panel->estimationComponentGroups as $i => $estimationComponentGroup): ?>
        <tr class="titems">
            <td>
                <?php if ($i == 0) : ?>
                    <?php echo CHtml::encode(CHtml::value($estimationComponentGroup, 'estimationPanel.panel_name')); ?>
                <?php endif; ?>
            </td>
            <td colspan ="9" style="font-weight: bold;"><?php echo CHtml::encode(CHtml::value($estimationComponentGroup, 'name')); ?></td>
        </tr>
        <?php foreach ($estimationComponentGroup->estimationComponents(array('order' => 'sort_number ASC')) as $i => $detail): ?>
            <tr class="titems">
                <td>
                    <?php //if ($i == 0) : ?>
                        <?php //echo CHtml::encode(CHtml::value($detail, 'estimationPanel.panel_name')); ?>
                    <?php //endif; ?>
                </td>
                <td style="text-align: left"><?php echo CHtml::encode(CHtml::value($detail, 'name')); ?></td>
                <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'brand.name')); ?></td>
                <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'type')); ?></td>
                <td></td>
                <td style="text-align: center"><?php echo ((int) $detail->is_lot === 1) ? '1 lot' : CHtml::encode(CHtml::value($detail, 'quantity')); ?></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'unit_price'))); ?></td></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'basicPriceOnly'))); ?></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'totalOnly'))); ?></td>
                <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'accesoriesPhase.nameFull')); ?></td>
                <!--<td style="text-align: right"><?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'accesories_phase_value')));   ?></td>-->

            </tr>

        <?php endforeach; ?>
    <?php endforeach; ?>

    <tr class="titems">

        <td style="border-top: thin solid ; "></td>
        <td style="border-top: thin solid ; "></td>
        <td style="border-top: thin solid ; "></td>
        <td style="border-top: thin solid ; "></td>
        <td style="border-top: thin solid ; "></td>
        <td style="border-top: thin solid ; "></td>
        <td style="border-top: thin solid ; "></td>
        <td style="border-top: thin solid ; "></td>
        <td style="border-top: thin solid ; "></td>
        <td style="border-top: thin solid ; "></td>
        <!--<td style="border-top: thin solid ; "></td>-->
    </tr>  

    <?php foreach ($panel->estimationComponentAccesories(array('order' => 'sort_number ASC')) as $detailAccesories): ?>
        <tr class="titems">
            <td></td>
            <td style="text-align: left">

                <?php echo CHtml::encode(CHtml::value($detailAccesories, 'name')); ?>
                <?php //if ($detailAccesories->component_id != NULL) : ?>
                <?php //echo CHtml::encode(CHtml::value($detailAccesories, 'component.name')); ?>
                <?php //else: ?>
                <?php //echo CHtml::encode(CHtml::value($detailAccesories, 'componentCu.name')); ?>
                <?php //endif; ?>
            </td>
            <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detailAccesories, 'brand.name')); ?></td>
            <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detailAccesories, 'type')); ?></td>
            <td style="text-align: right">
                <?php if ($detailAccesories->component_cu_id != NULL): ?>
                    <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detailAccesories, 'weight'))); ?>
                <?php endif; ?>
            </td>
            <td style="text-align: center"><?php echo ((int) $detailAccesories->is_lot === 1) ? '1 lot' : CHtml::encode(CHtml::value($detailAccesories, 'quantity')); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detailAccesories, 'unit_price'))); ?></td></td>
            <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detailAccesories, 'basicPriceOnly'))); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detailAccesories, 'totalOnly'))); ?></td>
            <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detailAccesories, 'accesoriesPhase.nameFull')); ?></td>
            <!--<td style="text-align: right"><?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detailAccesories, 'accesories_phase_value')));   ?></td>-->

        </tr>    

    <?php endforeach; ?>
    <tr class="titems">
        <td style="border-top: thin solid ; "></td>
        <td style="border-top: thin solid ; "></td>
        <td style="border-top: thin solid ; " colspan="4"></td>
        <td style="border-top: thin solid ; "></td>
        <td style="border-top: thin solid ; " colspan="3"></td>
    </tr>  

    <tr class="titems">
        <td></td>
        <td>Total Cu</td>
        <td colspan="4"></td>
        <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($panel, 'subTotalCu'))); ?></td>
        <td colspan="3"></td>
    </tr> 
    <tr class="titems">
        <td></td>
        <td>Accesories</td>
        <td colspan="4"></td>
        <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($panel, 'subTotalAccesoriesPhase'))); ?></td>
        <td colspan="3"></td>
    </tr> 
    <tr class="titems">
        <td></td>
        <td>Wiring</td>
        <td colspan="4"></td>
        <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($panel, 'subTotalWiring'))); ?></td>
        <td colspan="3"></td>
    </tr>
    <tr class="titems">
        <td style="border-top: 1px solid;"></td>
        <td style="border-top: 1px solid;font-weight: bold;">TOTAL PANEL</td>
        <td colspan="4" style="border-top: 1px solid;"></td>
        <td style="text-align: right;border-top: 1px solid;font-weight: bold;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($panel, 'grandTotal'))); ?></td>
        <td colspan="3" style="border-top: 1px solid;"></td>
    </tr>

    <tr class="titems">
        <td colspan="5" style="border-top: 1px solid black">&nbsp;</td>
        <td style="text-align: right; border-top: 1px solid black">Sub Total</td>
        <td style="text-align: right; border-top: 1px solid black;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($estimation, 'subTotal'))); ?></td>
        <td colspan="3" style="border-top: 1px solid black">&nbsp;</td>
    </tr>

</table>
<div id="link">
    <?php echo CHtml::link('Back To Estimation', array('backToEstimation', 'id' => $panel->estimation_header_id)); ?>
</div>