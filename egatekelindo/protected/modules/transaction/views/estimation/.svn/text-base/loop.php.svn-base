<?php
$this->breadcrumbs = array(
    'Estimation' => array('admin'),
    'Create',
);
?>
<h1>Estimation</h1>

<div class="form">

    <?php echo CHtml::beginForm(); ?>


    <div class="span-12">
        <div class="row">
            <?php echo CHtml::label('Estimation #', false); ?>
            <?php echo CHtml::encode($estimation->header->getCodeNumber($estimation->header->cn_initial)); ?>
        </div>

        <div class="row">
            <?php echo CHtml::label('Tanggal', false); ?>
            <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", $estimation->header->date)); ?>
        </div>

        <div class="row">
            <?php echo CHtml::label('Mark Up Wiring Low', false); ?>
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimation->header->mark_up_wiring_low)); ?>
        </div>
        <div class="row">
            <?php echo CHtml::label('Mark Up Wiring High', false); ?>
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimation->header->mark_up_wiring_high)); ?>
        </div>
        <div class="row">
            <?php echo CHtml::label('Mark Up Wiring Border', false); ?>
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimation->header->mark_up_wiring_border)); ?>
        </div>
        <div class="row">
            <?php echo CHtml::label('Mark Up Accesories', false); ?>
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimation->header->mark_up_accesories)); ?>
        </div>
        <div class="row">
            <?php echo CHtml::label('Mark Up All', false); ?>
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $estimation->header->mark_up_all)); ?>
        </div>
    </div>

    <div class="span-12 last">

        <div class="row">
            <?php echo CHtml::label('Project Name', false); ?>
            <?php echo CHtml::encode($estimation->header->project_name); ?>
        </div>

        <div class="row">
            <?php echo CHtml::label('Client Name', ''); ?>
            <?php echo CHtml::encode($estimation->header->client_name); ?>
        </div>

        <div class="row">
            <?php echo CHtml::label('Company', false); ?>
            <?php echo CHtml::encode($estimation->header->client_company); ?>
        </div>
        <div class="row">
            <?php echo CHtml::label('Catatan', ''); ?>
            <?php echo CHtml::encode($estimation->header->note); ?>
        </div>

    </div>
    <hr />

    <table style="border: 1px solid; width:30%">
        <tr style="background-color: skyblue">
            <th style="text-align: center;">Currency</th>
            <th style="text-align: center;">Rate</th>
        </tr>

        <?php foreach ($estimation->estimationCurrencies as $detail): ?>
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
        $estimationDetails = $estimation->details;
        usort($estimationDetails, function ($a, $b) {
                    if ($a['isPrimary'] == $b['isPrimary'])
                        return 0;
                    return ($a['isPrimary'] < $b['isPrimary']) ? 1 : -1;
                });
        ?>
        <?php $currentIsPrimary = NULL; ?>

        <?php foreach ($estimationDetails as $i => $detail): ?>
            <?php foreach ($estimation->estimationCurrencies as $currency) : ?>
                <?php if ($detail->estimation_currency_id == $currency->currency_id) : ?>
                    <?php $detail->currentRate = $currency->value; ?>
                    <?php echo CHtml::activeHiddenField($detail, "[$i]currentRate"); ?>

                <?php endif; ?>
                <?php echo CHtml::activeHiddenField($detail, "[$i]name"); ?>
                <?php echo CHtml::activeHiddenField($detail, "[$i]component_brand_discount_id"); ?>
                <?php echo CHtml::activeHiddenField($detail, "[$i]value_1"); ?>
                <?php echo CHtml::activeHiddenField($detail, "[$i]value_2"); ?>
                <?php echo CHtml::activeHiddenField($detail, "[$i]value_3"); ?>
                <?php echo CHtml::activeHiddenField($detail, "[$i]value_4"); ?>
                <?php echo CHtml::activeHiddenField($detail, "[$i]value_5"); ?>
            <?php endforeach; ?>
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
    <!--                <td style="text-align: center;"><?php //echo CHtml::encode(CHtml::value($detail, 'value_4'));     ?></td>
                <td style="text-align: center;"><?php //echo CHtml::encode(CHtml::value($detail, 'value_5'));     ?></td>-->
                <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($detail, 'currentRate')); ?></td>
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
            <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($panelDetail, 'panel_name')); ?></td>
        </tr>
    </table>

    <br/>
    <?php if (Yii::app()->user->hasFlash('errorDetail')): ?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('errorDetail'); ?>
        </div>
    <?php endif; ?>	

    <div class="row">
        <?php echo CHtml::button('Add Component', array('name' => 'Search', 'onclick' => '$("#component-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#component-dialog").dialog("open"); return false; }')); ?>
        <?php echo CHtml::hiddenField('ComponentId'); ?>
    </div>

    <br/>

    <div id="detail_component">
        <?php $this->renderPartial('_detailComponent', array('estimation' => $estimation, 'index' => $index, 'panelDetail' => $panelDetail)); ?>
    </div>

    <div class="row">
        <?php echo CHtml::button('Add Accesories', array('name' => 'Search', 'onclick' => '$("#accesories-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#accesories-dialog").dialog("open"); return false; }')); ?>
        <?php echo CHtml::hiddenField('ComponentAccesoriesId'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::button('Add CU', array('name' => 'Search', 'onclick' => '$("#cu-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#cu-dialog").dialog("open"); return false; }')); ?>
        <?php echo CHtml::hiddenField('ComponentCuId'); ?>
    </div>

    <br/>

    <div id="detail_accesories">
        <?php $this->renderPartial('_detailAccesories', array('estimation' => $estimation, 'index' => $index, 'panelDetail' => $panelDetail)); ?>
    </div>

    <div class="row buttons">
        <?php //echo CHtml::submitButton('Next', array('name'=>'Submit', 'confirm'=>'Are you sure you want to save?')); ?>
        <?php echo CHtml::submitButton('Next', array('name' => 'Next', 'confirm' => 'Are you sure you want to next?')); ?>
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
                url: "' . CController::createUrl('ajaxHtmlAddComponent', array('id' => $estimation->header->id, 'index' => $index)) . '",
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
    echo CHtml::ajaxSubmitButton('Add Component', CController::createUrl('ajaxHtmlAddComponents', array('id' => $estimation->header->id, 'index' => $index)), array(
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



<div>
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'accesories-dialog',
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Accesories',
            'autoOpen' => false,
            'width' => 'auto',
            'modal' => true,
        ),
    ));
    ?>

    <?php echo CHtml::beginForm('', 'post'); ?>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'product-for-accesories-grid',
        'dataProvider' => $dataProvider,
        'filter' => $component,
        'selectionChanged' => 'js:function(id) {
            $("#ComponentAccesoriesId").val($.fn.yiiGridView.getSelection(id));
            $("#accesories-dialog").dialog("close");
            $.ajax({
                type: "POST",
                url: "' . CController::createUrl('ajaxHtmlAddAccesories', array('id' => $estimation->header->id, 'index' => $index)) . '",
                data: $("form").serialize(),
                success: function(html) { $("#detail_accesories").html(html); },
            });
        }',
        'columns' => array(
            array(
                'id' => 'selectedIdsAccesories',
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
    echo CHtml::ajaxSubmitButton('Add Accesories', CController::createUrl('ajaxHtmlAddAccesories', array('id' => $estimation->header->id, 'index' => $index)), array(
        'type' => 'POST',
        'data' => 'js:$("form").serialize()',
        'success' => 'js:function(html) {
                            $("#detail_accesories").html(html);
                            $("#accesories-dialog").dialog("close");
                    }'
    ));
    ?>

    <?php echo CHtml::endForm(); ?>
    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</div>

<div>
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'cu-dialog',
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'CU',
            'autoOpen' => false,
            'width' => 'auto',
            'modal' => true,
        ),
    ));
    ?>

    <?php echo CHtml::beginForm('', 'post'); ?>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'cu-for-accesories-grid',
        'dataProvider' => $cuDataProvider,
        'filter' => $componentCu,
        'selectionChanged' => 'js:function(id) {
            $("#ComponentCuId").val($.fn.yiiGridView.getSelection(id));
            $("#cu-dialog").dialog("close");
            $.ajax({
                type: "POST",
                url: "' . CController::createUrl('ajaxHtmlAddCu', array('id' => $estimation->header->id, 'index' => $index)) . '",
                data: $("form").serialize(),
                success: function(html) { $("#detail_accesories").html(html); },
            });
        }',
        'columns' => array(
            array(
                'id' => 'selectedIdsCu',
                'class' => 'CCheckBoxColumn',
                'selectableRows' => '50',
            ),
            'name',
            'weight',
            array(
                'name' => 'unit_id',
                'filter' => CHtml::listData(Unit::model()->findAll(array('order' => 't.name')), 'id', 'name'),
                'value' => 'CHtml::value($data, "unit.name")',
            ),
        ),
    ));
    ?>
    <?php
    echo CHtml::ajaxSubmitButton('Add Cu', CController::createUrl('ajaxHtmlAddCu', array('id' => $estimation->header->id, 'index' => $index)), array(
        'type' => 'POST',
        'data' => 'js:$("form").serialize()',
        'success' => 'js:function(html) {
                            $("#detail_accesories").html(html);
                            $("#cu-dialog").dialog("close");
                    }'
    ));
    ?>

    <?php echo CHtml::endForm(); ?>
    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</div>