<h1>Requirement</h1>

<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="span-12">
        <div class="row">
            <?php echo CHtml::label('Budget #', false); ?>
            <?php echo CHtml::encode($budget->getCodeNumber(BudgetingHeader::CN_CONSTANT)); ?>
        </div>

        <div class="row">
            <?php echo CHtml::label('Tanggal', false); ?>
            <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", $budget->date)); ?>
        </div>

        <div class="row">
            <?php echo CHtml::label('Panel Name', false); ?>
            <?php echo CHtml::encode($saleOrderDetail->panel_name); ?>
        </div>



        <div class="row">
            <?php echo CHtml::button('Add Component', array('name' => 'Search', 'onclick' => '$("#component-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#component-dialog").dialog("open"); return false; }')); ?>
            <?php echo CHtml::hiddenField('ComponentId'); ?>
        </div>

    </div>
    <br/>

    <div id="detail_component">
        <?php $this->renderPartial('_detail', array('budgetingDetail' => $budgetingDetail, 'saleOrderDetail' => $saleOrderDetail)); ?>
    </div>
    <br/>
    <div class="row">
        <?php echo CHtml::button('Add Component Accesories', array('name' => 'Search', 'onclick' => '$("#component-dialog-accesories").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#component-dialog-accesories").dialog("open"); return false; }')); ?>
        <?php echo CHtml::hiddenField('ComponentIdAccesories'); ?>
    </div>

    <div id="detail_component_accesories">
        <?php $this->renderPartial('_detail_accesories', array('budgetingDetail' => $budgetingDetail, 'saleOrderDetail' => $saleOrderDetail)); ?>
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
                url: "' . CController::createUrl('ajaxHtmlAddComponentDetail', array('id' => $budgetingDetail->header->id, 'saleOrderDetailId' => $saleOrderDetail->id)) . '",
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
    echo CHtml::ajaxSubmitButton('Add Component', CController::createUrl('ajaxHtmlAddComponentDetail', array('id' => $budgetingDetail->header->id, 'saleOrderDetailId' => $saleOrderDetail->id)), array(
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
        'id' => 'component-dialog-accesories',
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Components Accesories',
            'autoOpen' => false,
            'width' => 'auto',
            'modal' => true,
        ),
    ));
    ?>

    <?php echo CHtml::beginForm('', 'post'); ?>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'product-grid-accesories',
        'dataProvider' => $dataProvider,
        'filter' => $component,
        'selectionChanged' => 'js:function(id) {
            $("#ComponentIdAccesories").val($.fn.yiiGridView.getSelection(id));
            $("#component-dialog-accesories").dialog("close");
            $.ajax({
                type: "POST",
                url: "' . CController::createUrl('ajaxHtmlAddComponentDetailAccesories', array('id' => $budgetingDetail->header->id, 'saleOrderDetailId' => $saleOrderDetail->id)) . '",
                data: $("form").serialize(),
                success: function(html) { $("#detail_component_accesories").html(html); },
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
    echo CHtml::ajaxSubmitButton('Add Component', CController::createUrl('ajaxHtmlAddComponentDetailAccesories', array('id' => $budgetingDetail->header->id, 'saleOrderDetailId' => $saleOrderDetail->id)), array(
        'type' => 'POST',
        'data' => 'js:$("form").serialize()',
        'success' => 'js:function(html) {
			$("#detail_component_accesories").html(html);
			$("#component-dialog-accesories").dialog("close");
		}'
    ));
    ?>

    <?php ?>

    <?php echo CHtml::endForm(); ?>
    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</div>

