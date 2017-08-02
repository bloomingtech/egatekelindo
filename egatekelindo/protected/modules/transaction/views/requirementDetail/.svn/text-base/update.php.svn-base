<h1>Requirement</h1>

<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="span-12">
        <div class="row">
            <?php echo CHtml::label('Requirement #', false); ?>
            <?php echo CHtml::encode($requirement->getCodeNumber($requirement->cnConstant)); ?>
        </div>

        <div class="row">
            <?php echo CHtml::label('Tanggal', false); ?>
            <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", $requirement->date)); ?>
        </div>

        <div class="row">
            <?php echo CHtml::label('Panel Name', false); ?>
            <?php echo CHtml::encode($requirementDetail->header->saleOrderDetail->panel_name); ?>
        </div>

        <?php if ($requirement->is_component): ?>

            <div class="row">
                <?php echo CHtml::button('Cari Component', array('name' => 'Search', 'onclick' => '$("#component-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#component-dialog").dialog("open"); return false; }')); ?>
                <?php echo CHtml::hiddenField('ComponentId'); ?>
            </div>
        <?php else : ?>
            <div class="row">
                <?php echo CHtml::button('Cari Cu', array('name' => 'Search', 'onclick' => '$("#cu-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#cu-dialog").dialog("open"); return false; }')); ?>
                <?php echo CHtml::hiddenField('ComponentCuId'); ?>
            </div>
        <?php endif; ?>
    </div>
    <br/>

    <div id="detail_component">
        <?php $this->renderPartial('_detail', array('requirement' => $requirement, 'requirementDetail' => $requirementDetail)); ?>
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
        'id' => 'component-grid',
        'dataProvider' => $dataProvider,
        'filter' => $component,
        'selectionChanged' => 'js:function(id) {
            $("#ComponentId").val($.fn.yiiGridView.getSelection(id));
            $("#component-dialog").dialog("close");
            $.ajax({
                type: "POST",
                url: "' . CController::createUrl('ajaxHtmlAddComponentDetail', array('id' => $requirementDetail->header->id)) . '",
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
    echo CHtml::ajaxSubmitButton('Add Component', CController::createUrl('ajaxHtmlAddComponentDetail', array('id' => $requirementDetail->header->id)), array(
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
        'id' => 'component-additional-dialog',
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Kerja Tambah Components',
            'autoOpen' => false,
            'width' => 'auto',
            'modal' => true,
        ),
    ));
    ?>

    <?php echo CHtml::beginForm('', 'post'); ?>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'component-additional-grid',
        'dataProvider' => $dataProvider,
        'filter' => $component,
        'selectionChanged' => 'js:function(id) {
            $("#ComponentAdditionalId").val($.fn.yiiGridView.getSelection(id));
            $("#component-additional-dialog").dialog("close");
            $.ajax({
                type: "POST",
                url: "' . CController::createUrl('ajaxHtmlAddComponentAdditionalDetail', array('id' => $requirementDetail->header->id)) . '",
                data: $("form").serialize(),
                success: function(html) { $("#detail_component_additional").html(html); },
            });
        }',
        'columns' => array(
            array(
                'id' => 'selectedAdditionalIds',
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
    echo CHtml::ajaxSubmitButton('Add Component', CController::createUrl('ajaxHtmlAddComponentAdditionalDetail', array('id' => $requirementDetail->header->id)), array(
        'type' => 'POST',
        'data' => 'js:$("form").serialize()',
        'success' => 'js:function(html) {
			$("#detail_component_additional").html(html);
			$("#component-additional-dialog").dialog("close");
		}'
    ));
    ?>

    <?php ?>

    <?php echo CHtml::endForm(); ?>
    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
<!--</div>-->


<div>
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'cu-dialog',
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Cu',
            'autoOpen' => false,
            'width' => 'auto',
            'modal' => true,
        ),
    ));
    ?>

    <?php echo CHtml::beginForm('', 'post'); ?>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'cu-grid',
        'dataProvider' => $cuDataProvider,
        'filter' => $componentCu,
        'selectionChanged' => 'js:function(id) {
            $("#ComponentCuId").val($.fn.yiiGridView.getSelection(id));
            $("#cu-dialog").dialog("close");
            $.ajax({
                type: "POST",
                url: "' . CController::createUrl('ajaxHtmlAddComponentCuDetail', array('id' => $requirementDetail->header->id)) . '",
                data: $("form").serialize(),
                success: function(html) { $("#detail_component").html(html); },
            });
        }',
        'columns' => array(
            array(
                'id' => 'selectedCuIds',
                'class' => 'CCheckBoxColumn',
                'selectableRows' => '50',
            ),
            'name',
            'weight',
        ),
    ));
    ?>
    <?php
    echo CHtml::ajaxSubmitButton('Add Cu', CController::createUrl('ajaxHtmlAddComponentCuDetail', array('id' => $requirementDetail->header->id)), array(
        'type' => 'POST',
        'data' => 'js:$("form").serialize()',
        'success' => 'js:function(html) {
			$("#detail_component").html(html);
			$("#cu-dialog").dialog("close");
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
        'id' => 'cu-additional-dialog',
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Cu (additional)',
            'autoOpen' => false,
            'width' => 'auto',
            'modal' => true,
        ),
    ));
    ?>

    <?php echo CHtml::beginForm('', 'post'); ?>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'cu-additional-grid',
        'dataProvider' => $cuDataProvider,
        'filter' => $componentCu,
        'selectionChanged' => 'js:function(id) {
            $("#ComponentCuAdditionalId").val($.fn.yiiGridView.getSelection(id));
            $("#cu-additional-dialog").dialog("close");
            $.ajax({
                type: "POST",
                url: "' . CController::createUrl('ajaxHtmlAddComponentCuAdditionalDetail', array('id' => $requirementDetail->header->id)) . '",
                data: $("form").serialize(),
                success: function(html) { $("#detail_component_additional").html(html); },
            });
        }',
        'columns' => array(
            array(
                'id' => 'selectedCuAdditionalIds',
                'class' => 'CCheckBoxColumn',
                'selectableRows' => '50',
            ),
            'name',
            'weight',
        ),
    ));
    ?>
    <?php
    echo CHtml::ajaxSubmitButton('Add Cu', CController::createUrl('ajaxHtmlAddComponentCuAdditionalDetail', array('id' => $requirementDetail->header->id)), array(
        'type' => 'POST',
        'data' => 'js:$("form").serialize()',
        'success' => 'js:function(html) {
			$("#detail_component_additional").html(html);
			$("#cu-additional-dialog").dialog("close");
		}'
    ));
    ?>

    <?php ?>

    <?php echo CHtml::endForm(); ?>
    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</div>

