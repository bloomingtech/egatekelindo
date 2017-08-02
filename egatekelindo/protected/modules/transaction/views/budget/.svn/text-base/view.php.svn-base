<?php
$this->breadcrumbs = array(
    'estimation' => array('/transaction/budget/create'),
    'view',
);
?>

<h1>
    <?php echo $this->id . '/' . $this->action->id; ?>
</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $budget,
    'attributes' => array(
        array(
            'label' => 'Budget #',
            'value' => CHtml::encode($budget->getCodeNumber(BudgetingHeader::CN_CONSTANT)),
        ),
        array(
            'label' => 'Tanggal',
            'value' => CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', CHtml::value($budget, 'date'))),
        ),
         array(
            'label' => 'SO #',
            'value' => CHtml::encode($budget->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)),
        ),
	array(
            'label' => 'Project',
            'value' => CHtml::encode(CHtml::value($budget, 'saleOrderHeader.project_name')),
        ),
        array(
            'label' => 'Company',
            'value' => CHtml::encode(CHtml::value($budget, 'saleOrderHeader.client_company')),
        ),
        array(
            'label' => 'Name',
            'value' => CHtml::encode(CHtml::value($budget, 'saleOrderHeader.client_name')),
        ),
        array(
            'label' => 'Note',
            'value' => CHtml::encode(CHtml::value($budget, 'note'))
        ),
    ),
));
?>

<?php
//$this->widget('zii.widgets.grid.CGridView', array(
//    'id' => 'estimation-brand-discount-grid',
//    'dataProvider' => $discountDataProvider,
//    'columns' => array(
//        array(
//            'header' => 'Brand',
//            'value' => 'CHtml::encode(CHtml::value($data,"brand.name"))'
//        ),
//        array(
//            'header' => 'Disc 1',
//            'value' => 'CHtml::encode(CHtml::value($data,"discount_value_1"))'
//        ),
//        array(
//            'header' => 'Type 1',
//            'value' => 'CHtml::encode(CHtml::value($data,"type1"))'
//        ),
//        array(
//            'header' => 'Disc 2',
//            'value' => 'CHtml::encode(CHtml::value($data,"discount_value_2"))'
//        ),
//        array(
//            'header' => 'Type 2',
//            'value' => 'CHtml::encode(CHtml::value($data,"type2"))'
//        ),
//        array(
//            'header' => 'Disc 3',
//            'value' => 'CHtml::encode(CHtml::value($data,"discount_value_3"))'
//        ),
//        array(
//            'header' => 'Type 3',
//            'value' => 'CHtml::encode(CHtml::value($data,"type3"))'
//        ),
//        array(
//            'header' => 'Disc 4',
//            'value' => 'CHtml::encode(CHtml::value($data,"discount_value_4"))'
//        ),
//        array(
//            'header' => 'Type 4',
//            'value' => 'CHtml::encode(CHtml::value($data,"type4"))'
//        ),
//        array(
//            'header' => 'Disc 5',
//            'value' => 'CHtml::encode(CHtml::value($data,"discount_value_5"))'
//        ),
//        array(
//            'header' => 'Type 5',
//            'value' => 'CHtml::encode(CHtml::value($data,"type5"))'
//        ),
//        array(
//            'header' => 'Status',
//            'value' => 'CHtml::encode(CHtml::value($data,"status"))'
//        ),
//        )));
?>

<?php
//    $this->widget('zii.widgets.grid.CGridview', array(
//       'id'=>'estimation-panel-grid',
//        'dataProvider'=>$panelDataProvider,
//        'columns'=>array(
//            array(
//                'header'=>'Panel',
//                'value'=>'CHtml::encode(CHtml::value($data,"panel_name"))'
//            ),
//            array(
//                'header'=>'Status',
//                'value'=>'CHtml::encode(CHtml::value($data,"status"))'
//            ),
//    )));
?>

<?php
//$this->widget('zii.widgets.grid.CGridView', array(
//    'id' => 'estimation-component-panel-grid',
//    'dataProvider' => $detailDataProvider,
//    'columns' => array(
//        array(
//            'header' => 'Panel Name',
//            'value' => 'CHtml::encode(CHtml::value($data,"estimationComponent.estimationPanel.panel_name"))',
//            'htmlOptions' => array(
//                'style' => 'text-align: center',
//            ),
//        ),
//        array(
//            'header' => 'Name',
//            'value' => 'CHtml::encode(CHtml::value($data,"estimationComponent.component.name"))'
//        ),
//        array(
//            'header' => 'Quantity',
//            'value' => 'CHtml::encode(CHtml::value($data,"estimationComponent.quantity"))'
//        ),
//        array(
//            'header' => 'Unit Price',
//            'value' => 'CHtml::encode(CHtml::value($data,"estimationComponent.unit_price"))'
//        ),
//        array(
//            'header' => 'Accesories Main',
//            'value' => 'CHtml::encode(CHtml::value($data,"estimationComponent.accesoriesIdMain.type"))'
//        ),
//        array(
//            'header' => 'Accesories Secondary',
//            'value' => 'CHtml::encode(CHtml::value($data,"estimationComponent.accesoriesIdSecondary.type"))'
//        ),
//        array(
//            'header' => 'Total',
//            'value' => 'number_format($data->estimationComponent->total, 2)',
//            'htmlOptions' => array(
//                'style' => 'text-align: right',
//            ),
//        ),
//        )));
?>
<!--<table>
    <tr style="background-color: skyblue">
        <td style="text-align: right; width: 80%; font-weight: bold">Sub Total:</td>
        <td style="text-align: right; font-weight: bold">
<?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::encode(CHtml::value($budget, 'estimationHeader.subTotal')))); ?>
        </td>
    </tr>
</table>-->

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
        <th style="width: 10%; border-top:1px solid; border-bottom: 1px solid;text-align: right;">Currency</th>
    </tr>
    <?php
    $budgetingBrandDiscounts = $budget->budgetingBrandDiscounts;

    foreach ($budgetingBrandDiscounts as $i => $budgetingBrandDiscount)
        $budgetingBrandDiscounts[$i]->isPrimary = $budgetingBrandDiscount->componentBrandDiscount->is_primary;

    usort($budgetingBrandDiscounts, function ($a, $b) {
                if ($a['isPrimary'] == $b['isPrimary'])
                    return 0;
                return ($a['isPrimary'] < $b['isPrimary']) ? 1 : -1;
            });
    ?>
    <?php $currentIsPrimary = NULL; ?>
    <?php foreach ($budgetingBrandDiscounts as $budgetingBrandDiscount): ?>
        <?php if ($budgetingBrandDiscount->isPrimary != $currentIsPrimary && $currentIsPrimary != NULL) : ?>
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
            <td><?php echo CHtml::encode(CHtml::value($budgetingBrandDiscount, 'name')); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($budgetingBrandDiscount, 'value_1')); ?></td>
            <td style="text-align: right"><?php echo $budgetingBrandDiscount->getTypeString($budgetingBrandDiscount->value_calculation_type_1); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($budgetingBrandDiscount, 'value_2')); ?></td>
            <td style="text-align: right"><?php echo $budgetingBrandDiscount->getTypeString($budgetingBrandDiscount->value_calculation_type_2); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($budgetingBrandDiscount, 'value_3')); ?></td>
            <td style="text-align: right"><?php echo $budgetingBrandDiscount->getTypeString($budgetingBrandDiscount->value_calculation_type_3); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($budgetingBrandDiscount, 'value_4')); ?></td>
            <td style="text-align: right"><?php echo $budgetingBrandDiscount->getTypeString($budgetingBrandDiscount->value_calculation_type_4); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($budgetingBrandDiscount, 'budgetingCurrency.value')); ?></td>

        </tr>
        <?php $currentIsPrimary = $budgetingBrandDiscount->isPrimary; ?>
    <?php endforeach; ?>
</table>

<br/>
<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th>Panel Name</th>
        <th>&nbsp;</th>
    </tr>
    <?php foreach ($detailDataProvider->data as $detail) : ?>
        <tr>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'panel_name')); ?></td>
            <td><div id="link">
                    <?php echo CHtml::link('View', array('budgetingDetail/view', 'id' => $detail->id, 'headerId' => $budget->id)); ?>
                    <?php echo CHtml::link('Edit', array('budgetingDetail/update', 'id' => $detail->id, 'headerId' => $budget->id)); ?>
                    <?php //echo CHtml::link('Upload Detail', array('uploadDetail', 'id' => $detail->id, 'headerId' => $budget->id)); ?>
                    <?php //echo CHtml::link('Upload Accesories', array('uploadDetailAccesories', 'id' => $detail->id, 'headerId' => $budget->id)); ?>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<br/>
<div id="link">
    <?php echo CHtml::link('Create', array('saleOrderList')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Print', array('memo', 'id' => $budget->id), array('target' => '_blank')); ?>
</div>
