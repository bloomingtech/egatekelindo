<div class="form">

    <?php echo CHtml::beginForm(); ?>
    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('Pembayaran #', false); ?>
                <span id="code_number">
                    <?php echo CHtml::encode($salePayment->header->getCodeNumber(SalePaymentHeader::CN_CONSTANT)); ?>
                </span>	
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal Pembayaran', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $salePayment->header,
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
                <?php echo CHtml::error($salePayment->header, 'date'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Bank', ''); ?>
                <?php echo CHtml::activeTextField($salePayment->header, 'bank_name'); ?>
                <?php echo CHtml::error($salePayment->header, 'bank_name'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal Cheque', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $salePayment->header,
                    'attribute' => 'cheque_date',
                    // additional javascript options for the date picker plugin
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'readonly' => true,
                    ),
                ));
                ?>
                <?php echo CHtml::error($salePayment->header, 'date'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('No Cheque', ''); ?>
                <?php echo CHtml::activeTextField($salePayment->header, 'cheque_number'); ?>
                <?php echo CHtml::error($salePayment->header, 'cheque_number'); ?>

            </div>


        </div>

        <div class="span-12 last">



            <?php echo CHtml::label('Retur Penjualan #', ''); ?>
            <?php //if ($salePayment->header->isNewRecord): ?>
            <?php
            echo CHtml::activeTextField($salePayment->header, 'sale_return_header_id', array(
                'readonly' => true,
                'onclick' => '$("#sale-return-header-dialog").dialog("open"); return false;',
                'onkeypress' => 'if (event.keyCode == 13) { $("#sale-return-header-dialog").dialog("open"); return false; }'));
            ?>
            <?php //elseif($salePayment->header->saleReturnHeader): ?>
            <?php
            echo ($salePayment->header->saleReturnHeader != null) ? CHtml::encode($salePayment->header->saleReturnHeader->getCodeNumber(SaleReturnHeader::CN_CONSTANT)) : '';
            ?>
            <?php //echo CHtml::activeHiddenField($salePayment->header, 'sale_return_header_id', array('value' => $salePayment->header->sale_return_header_id)); ?>
            <?php //endif; ?>
            <span id="sale_return_header_codeNumber">
                <?php //echo CHtml::encode(CHtml::value($salePayment->header,'saleReturnHeader.codeNumber')); ?>
            </span>
            <?php echo CHtml::error($salePayment->header, 'sale_return_header_id'); ?>

            <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                'id' => 'sale-return-header-dialog',
                // additional javascript options for the dialog plugin
                'options' => array(
                    'title' => 'Sale Return Header',
                    'autoOpen' => false,
                    'width' => 'auto',
                    'modal' => true,
                ),
            ));
            ?>
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'sale-return-header-grid',
                'dataProvider' => $saleReturnDataProvider,
                'filter' => $saleReturnHeader,
                'selectionChanged' => 'js:function(id) {
						$("#' . CHtml::activeId($salePayment->header, 'sale_return_header_id') . '").val($.fn.yiiGridView.getSelection(id));
						$("#sale-return-header-dialog").dialog("close");

						//reset detail
						$.ajax({
							type: "POST",
							url: "' . CController::createUrl('ajaxHtmlResetDetailRetur', array('id' => $salePayment->header->id)) . '",
							data: $("form").serialize(),
							success: function(html) { $("#detail_div").html(html); },
						});

						if ($.fn.yiiGridView.getSelection(id) == "")
						{
							$("#sale_return_header_codeNumber").html("");
							$("#sale_return_header_date").html("");
						}
						else
						{
							$.ajax({
								type: "POST",
								dataType: "JSON",
								url: "' . CController::createUrl('AjaxJsonSaleReturn', array('id' => $salePayment->header->id)) . '",
								data: $("form").serialize(),
								success: function(data) {
									$("#sale_return_header_codeNumber").html(data.sale_return_header_codeNumber);
									$("#sale_return_header_date").html(data.sale_return_header_date);
									$("#totalSaleReturn").html(data.totalSaleReturn);
									$("#grand_total").html(data.grandTotal);
								},
							});
						}
					}',
                'columns' => array(
                    array(
                        'name' => 'cn_ordinal',
                        'header' => 'Retur Penjualan #',
                        'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($saleReturnHeader, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
                        '<div style="display: inline-block"> &nbsp; /' . SaleReturnHeader::CN_CONSTANT . '/ &nbsp; </div>' .
                        '<div style="display: inline-block">' . CHtml::activeDropDownList($saleReturnHeader, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
                        '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
                        '<div style="display: inline-block">' . CHtml::activeTextField($saleReturnHeader, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
                        'value' => '$data->getCodeNumber(SaleReturnHeader::CN_CONSTANT)',
                        'htmlOptions' => array('style' => 'width: 200px'),
                    ),
                    array(
                        'header' => 'Tanggal',
                        'name' => 'date',
                        'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
                    ),
                    array(
                        'header' => 'Total Sale Return',
                        'value' => 'number_format($data->getGrandTotal(), 2)',
                        'htmlOptions' => array('style' => 'text-align: right')
                    ),
                ),
            ));
            ?>
            <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

            <div class="row">
                <?php echo CHtml::activeLabelEx($salePayment->header, 'Tanggal Retur'); ?>
                <span id="sale_return_header_date">
                    <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($salePayment->header->saleReturnHeader, 'date'))); ?>
                </span>
            </div>

            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($salePayment->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($salePayment->header, 'note'); ?>
            </div>

        </div>
    </div>

    <hr />

    <div class="row buttons">
        <?php echo CHtml::button('Tambah Sale Invoice', array('name' => 'Search', 'onclick' => '$("#sale-invoice-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#sale-invoice-dialog").dialog("open"); return false; }')); ?>
        <?php echo CHtml::hiddenField('SaleInvoiceId'); ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('salePayment' => $salePayment)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->

<div>
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'sale-invoice-dialog',
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Sale Invoice',
            'autoOpen' => false,
            'width' => 'auto',
            'modal' => true,
        ),
    ));
    ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'sale-invoice-grid',
        'dataProvider' => $saleInvoiceDataProvider,
        'filter' => $saleInvoice,
        'selectionChanged' => 'js:function(id) {
			$("#SaleInvoiceId").val($.fn.yiiGridView.getSelection(id));
			$("#sale-invoice-dialog").dialog("close");
			$.ajax({
				type: "POST",
				url: "' . CController::createUrl('ajaxHtmlAddSaleInvoice', array('id' => $salePayment->header->id)) . '",
				data: $("form").serialize(),
				success: function(html) { 
					$("#detail_div").html(html); 
				},
			});
		}',
        'columns' => array(
            array(
                'name' => 'cn_ordinal',
                'header' => 'Faktur Penjualan #',
                'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($saleInvoice, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
                '<div style="display: inline-block"> &nbsp; /' . SaleInvoiceHeader::CN_CONSTANT . '/ &nbsp; </div>' .
                '<div style="display: inline-block">' . CHtml::activeDropDownList($saleInvoice, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
                '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
                '<div style="display: inline-block">' . CHtml::activeTextField($saleInvoice, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
                'type' => 'raw',
                'value' => '$data->getCodeNumber(SaleInvoiceHeader::CN_CONSTANT)',
                'htmlOptions' => array('style' => 'width: 200px'),
            ),
            array(
                'header' => 'Tanggal',
                'name' => 'date',
                'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
            ),
            array(
                'header' => 'Total',
                'filter' => false,
                'value' => 'number_format($data->grand_total, 2)',
                'htmlOptions' => array('style' => 'text-align: right'),
            ),
            array(
                'header' => 'Lunas',
                'filter' => false,
                'value' => 'number_format($data->total_payment, 2)',
                'htmlOptions' => array('style' => 'text-align: right'),
            ),
//			array(
//                'header' => 'Sisa',
//                'filter' => false,
//                'value' => 'number_format($data->paymentRemaining, 2)',
//				'htmlOptions' => array('style' => 'text-align: right'),
//            ),
        ),
    ));
    ?>

    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</div>