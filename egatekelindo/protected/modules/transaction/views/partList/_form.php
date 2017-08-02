<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('Part List #', false); ?>
                <?php echo CHtml::encode($partList->header->getCodeNumber(PartListHeader::CN_CONSTANT)); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $partList->header,
                    'attribute' => 'date',
                    // additional javascript options for the date picker plugin
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'readonly' => true,
                    ),
                ));
                ?>
                <?php echo CHtml::error($partList->header, 'date'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($partList->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($partList->header, 'note'); ?>
            </div>

        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('Sales Order #', ''); ?>
                <?php if ($partList->header->isNewRecord): ?>
                    <?php echo CHtml::activeTextField($partList->header, 'sale_order_header_id', array('readonly' => true, 'onclick' => '$("#sale-header-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#sale-header-dialog").dialog("open"); return false; }')); ?>
                    <?php echo CHtml::openTag('span', array('id' => 'sale_order_code_number')); ?>
                    <?php echo CHtml::encode(($saleOrder === null) ? '' : $saleOrder->getNumber(SaleOrder::CN_CONSTANT)); ?>
                    <?php echo CHtml::closeTag('span'); ?>
                    <?php echo CHtml::error($partList->header, 'sale_order_header_id'); ?>

                    <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'sale-header-dialog',
                        // additional javascript options for the dialog plugin
                        'options' => array(
                            'title' => 'Order Penjualan',
                            'autoOpen' => false,
                            'width' => 'auto',
                            'modal' => true,
                        ),
                    ));
                    ?>
                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'sale-header-grid',
                        'dataProvider' => $saleOrderDataProvider,
                        'filter' => $saleOrder,
                        'selectionChanged' => 'js:function(id) {
							$("#' . CHtml::activeId($partList->header, 'sale_order_header_id') . '").val($.fn.yiiGridView.getSelection(id));
							$("#sale-header-dialog").dialog("close");
							if ($.fn.yiiGridView.getSelection(id) == "")
							{
								$("#sale_order_code_number").html("");
								$("#sale_order_date").html("");
					
							}
							else
							{
								$.ajax({
									type: "POST",
									dataType: "JSON",
									url: "' . CController::createUrl('AjaxJsonSale', array('id' => $partList->header->id)) . '",
									data: $("form").serialize(),
									success: function(data) {
										$("#sale_order_code_number").html(data.sale_order_code_number);
										$("#sale_order_date").html(data.sale_order_date);
										
									},
								});
							}
							
						}',
                        'columns' => array(
                            array(
                                'name' => 'cn_ordinal',
                                'header' => 'Order #',
                                'filter' => 
                                '<div style="display: inline-block"> &nbsp; ' . SaleOrder::CN_CONSTANT . '&nbsp; </div>' .
                                '<div style="display: inline-block">' . CHtml::activeTextField($saleOrder, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>'.
                                '<div style="display: inline-block">' . CHtml::activeTextField($saleOrder, 'cn_month', array('maxLength' => 2, 'size' => 2)) . '</div>'.
                                '<div style="display: inline-block">' . CHtml::activeDropDownList($saleOrder, 'is_temporary', array(ActiveRecord::ACTIVE => 'Real', ActiveRecord::INACTIVE => 'Sementara'), array('empty' => '')) . '</div>' .
                                '<div style="display: inline-block">' . CHtml::activeTextField($saleOrder, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
                                '<div style="display: inline-block"> &nbsp; </div>' ,

                                'value' => '$data->getNumber(SaleOrder::CN_CONSTANT)',
                                'htmlOptions' => array('style' => 'width: 200px'),
                            ),
                            array(
                                'header' => 'Tanggal',
                                'name' => 'date',
                                'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
                            ),
                        ),
                    ));
                    ?>
                    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
                <?php else: ?>
                    <?php echo CHtml::encode($partList->header->saleOrder->getNumber(SaleOrder::CN_CONSTANT)); ?>
                    <?php echo CHtml::activeHiddenField($partList->header, 'sale_order_header_id', array('value' => $partList->header->sale_order_header_id)); ?>
                <?php endif; ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal Jual', ''); ?>
                <span id="sale_order_date">
                    <?php if (!$partList->header->isNewRecord): ?>
                        <?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($partList->header->saleOrder->date))); ?>
                    <?php endif; ?>
                </span>
            </div>

            <div class="row">
                <?php echo CHtml::label('SPK #', '', array('class' => 'required')); ?>
                <?php echo CHtml::activeTextField($partList->header, 'work_order_number'); ?>
                <?php echo CHtml::error($partList->header, 'work_order_number'); ?>
            </div>

        </div>
    </div>

    <hr />
    <div class="row">
        <?php echo CHtml::button('Cari Komponen', array('name' => 'Search', 'onclick' => '$("#search-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#search-dialog").dialog("open"); return false; }')); ?>
        <?php echo CHtml::hiddenField('ComponentId'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::error($partList->header, 'error'); ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('partList' => $partList)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?', 'class' => 'btn_blue')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->


<div>
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'search-dialog',
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Components',
            'autoOpen' => false,
            'width' => 'auto',
            'modal' => true,
        ),
    ));
    ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'product-grid',
        'dataProvider' => $dataProvider,
        'filter' => $component,
        'selectionChanged' => 'js:function(id) {
			$("#ComponentId").val($.fn.yiiGridView.getSelection(id));
			$("#search-dialog").dialog("close");
			$.ajax({
				type: "POST",
				url: "' . CController::createUrl('ajaxHtmlAddComponent', array('id' => $partList->header->id,)) . '",
				data: $("form").serialize(),
				success: function(html) { $("#detail_div").html(html); },
			});
		}',
        'columns' => array(
            'name',
            array(
                'header' => 'Brand',
                'name' => 'component_brand_id',
                'filter' => CHtml::listData(ComponentBrand::model()->findAll(), 'id', 'name'),
                'value' => 'CHtml::value($data, "componentBrand.name")',
            ),
        ),
    ));
    ?>

    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</div>
