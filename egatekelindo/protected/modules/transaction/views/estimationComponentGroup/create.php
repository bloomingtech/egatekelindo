<h1>Estimation</h1>

<div class="form">

    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($estimationComponentGroup->header); ?>

    <div class="span-12">
        <div class="row">
            <?php echo CHtml::label('Estimation #', false); ?>
            <?php echo CHtml::encode($estimationHeader->getCodeNumber($estimationHeader->cn_initial)); ?>
        </div>

        <div class="row">
            <?php echo CHtml::label('Tanggal', false); ?>
            <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", $estimationHeader->date)); ?>
        </div>

        <div class="row">
            <?php echo CHtml::label('Mark Up Wiring Low', false); ?>
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimationHeader->mark_up_wiring_low)); ?>
        </div>
        <div class="row">
            <?php echo CHtml::label('Mark Up Wiring High', false); ?>
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimationHeader->mark_up_wiring_high)); ?>
        </div>
        <div class="row">
            <?php echo CHtml::label('Mark Up Wiring Border', false); ?>
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimationHeader->mark_up_wiring_border)); ?>
        </div>
        <div class="row">
            <?php echo CHtml::label('Mark Up Accesories', false); ?>
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimationHeader->mark_up_accesories)); ?>
        </div>
        <div class="row">
            <?php echo CHtml::label('Mark Up All', false); ?>
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimationHeader->mark_up_all)); ?>
        </div>
    </div>

    <div class="span-12 last">

        <div class="row">
            <?php echo CHtml::label('Project Name', false); ?>
            <?php echo CHtml::encode($estimationHeader->project_name); ?>
        </div>

        <div class="row">
            <?php echo CHtml::label('Client Name', ''); ?>
            <?php echo CHtml::encode($estimationHeader->client_name); ?>
        </div>

        <div class="row">
            <?php echo CHtml::label('Company', false); ?>
            <?php echo CHtml::encode($estimationHeader->client_company); ?>
        </div>
        <div class="row">
            <?php echo CHtml::label('Catatan', ''); ?>
            <?php echo CHtml::encode($estimationHeader->note); ?>
        </div>

    </div>
    <hr />

    <table style="border: 1px solid; width:30%">
        <tr style="background-color: skyblue">
            <th style="text-align: center;">Currency</th>
            <th style="text-align: center;">Rate</th>
        </tr>

        <?php foreach ($estimationHeader->estimationCurrencies as $detail): ?>
            <tr>
                <td><?php echo CHtml::encode(CHtml::value($detail, 'currency.name')); ?></td>
                <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($detail, 'value')); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <table style="border: 1px solid">
        <tr style="background-color: skyblue">
            <th style="text-align: center;">Brand</th>
            <th style="text-align: center;">Value1</th>
            <th style="text-align: center;">Value2</th>
            <th style="text-align: center;">Value3</th>
<!--            <th style="text-align: center;">Value4</th>
            <th style="text-align: center;">Value5</th>-->
            <th style="text-align: center;">Currency Rate</th>
        </tr>
        <?php
        $estimationDetails = $estimationHeader->estimationBrandDiscounts;

        foreach ($estimationDetails as $i => $detail)
            $estimationDetails[$i]->isPrimary = $detail->componentBrandDiscount->is_primary;
        usort($estimationDetails, function ($a, $b) {
                    if ($a['isPrimary'] == $b['isPrimary'])
                        return 0;
                    return ($a['isPrimary'] < $b['isPrimary']) ? 1 : -1;
                });
        ?>
        <?php $currentIsPrimary = NULL; ?>

        <?php foreach ($estimationDetails as $i => $detail): ?>
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
                <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($detail, 'value_1')); ?></td>
                <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($detail, 'value_2')); ?></td>
                <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($detail, 'value_3')); ?></td>
                <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($detail, 'estimationCurrency.value')); ?></td>
            </tr>
            <?php $currentIsPrimary = $detail->isPrimary; ?>
        <?php endforeach; ?>
    </table>

    <hr />

    <table style="border: 1px solid">
        <tr style="background-color: skyblue">
            <th style="text-align: center;">Panel Name</th>
        </tr>
        <tr>
            <td style="text-align: center;">
               <?php echo CHtml::encode(CHtml::value($estimationComponentGroup->header->estimationPanel, 'panel_name')); ?>
            </td>
        </tr>
        <tr style="background-color: skyblue">
            <th style="text-align: center;">Component Group</th>
        </tr>
        <tr>
            <td style="text-align: center;">
               <?php echo CHtml::encode(CHtml::value($estimationComponentGroup->header, 'name')); ?>
            </td>
        </tr>
    </table>

    <br/>
    
    <div class="row">
        <?php echo CHtml::button('Add Component', array('name' => 'Search', 'onclick' => '$("#component-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#component-dialog").dialog("open"); return false; }')); ?>
        <?php echo CHtml::hiddenField('ComponentId'); ?>
    </div>

    <div id="detail_component">
        <?php $this->renderPartial('_addPanelComponent', array('estimationComponentGroup' => $estimationComponentGroup)); ?>
    </div>

   
    <div class="row buttons">
        <?php echo CHtml::submitButton('Save', array('name' => 'Save', 'confirm' => 'Are you sure you want to save?')); ?>
    </div>
    <?php echo CHtml::endForm(); ?>

</div><!-- form -->



<div>
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'component-dialog',
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Components',
            'autoOpen' => false,
            'width' => 'auto',
            'modal' => true,
        ),
    ));
    ?>

    <?php echo CHtml::beginForm('', 'post'); ?>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'product-grid',
        'dataProvider' => $dataProvider,
        'filter' => $component,
        'selectionChanged' => 'js:function(id) {
            $("#ComponentId").val($.fn.yiiGridView.getSelection(id));
            $("#component-dialog").dialog("close");
            $.ajax({
                type: "POST",
                url: "' . CController::createUrl('ajaxHtmlAddComponentPanel', array('id' => $estimationComponentGroup->header->id)) . '",
                data: $("form").serialize(),
                success: function(html) { $("#detail_component").html(html); },
            });
        }',
        'columns' => array(
            array(
                'id' => 'selectedIds',
                'class' => 'CCheckBoxColumn',
                'selectableRows' => '50',
            ),
            array(
                'name' => 'component_category_id',
                'filter' => CHtml::listData(ComponentCategory::model()->findAll(array('order' => 't.name')), 'id', 'name'),
                'value' => 'CHtml::value($data, "componentCategory.name")',
            ),
            'name',
            array(
                'name' => 'component_brand_id',
                'filter' => CHtml::listData(ComponentBrand::model()->findAll(array('order' => 't.name')), 'id', 'name'),
                'value' => 'CHtml::value($data, "componentBrand.name")',
            ),
            'type',
            'selling_price',
        ),
    ));
    ?>
    <?php
    echo CHtml::ajaxSubmitButton('Add Component', CController::createUrl('ajaxHtmlAddComponentPanel', array('id' => $estimationComponentGroup->header->id)), array(
        'type' => 'POST',
        'data' => 'js:$("form").serialize()',
        'success' => 'js:function(html) {
			$("#detail_component").html(html);
			$("#component-dialog").dialog("close");
		}'
    ));
    ?>

    <?php ?>

    <?php echo CHtml::endForm(); ?>
    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</div>


