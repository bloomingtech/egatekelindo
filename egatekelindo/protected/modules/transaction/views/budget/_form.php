<div class ="form">
    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($budget->header); ?>

    <table> 
        <tr>
            <td>
                <?php echo CHtml::label('Budget #', false); ?>
                <?php if ($budget->header->isNewRecord) : ?>
                    <?php //echo CHtml::activeTextField($budget->header, 'cn_ordinal', array('size' => 10, 'maxlength' => 20)); ?>
                    <?php //echo CHtml::error($budget->header, 'cn_ordinal'); ?>
                    <?php //echo CHtml::error($budget->header, 'ordinal'); ?>
                <?php else : ?>
                    <?php echo CHtml::encode($budget->header->getCodeNumber(BudgetingHeader::CN_CONSTANT)); ?>
                <?php endif; ?>
                <?php //echo CHtml::encode($budget->header->getCodeNumber(BudgetingHeader::CN_CONSTANT)); ?> 
            </td>
            <td>
                <?php echo CHtml::label('Sale Order', ''); ?>
                <?php echo CHtml::encode($budget->header->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)); ?> 
                <?php
//                echo CHtml::activeTextField($budget->header, 'sale_order_header_id', array(
//                    'readonly' => TRUE,
//                    'onclick' => '$("#sale-order-dialog").dialog("open"); return false;',
//                    'onkeypress' => 'if(event.keyCode == 13){$("#sale-order-dialog").dialog("open");return false;
//                            }'));
                ?>
                <?php echo CHtml::error($budget->header, 'sale_order_header_id'); ?>
            </td>

        </tr>
        <tr>
            <td>
                <?php echo CHtml::label('Tanggal', ''); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $budget->header,
                    'attribute' => 'date',
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'readonly' => true,
                    ),
                ));
                ?>
                <?php echo CHtml::error($budget->header, 'date'); ?>
            </td>
            <td>
                <?php echo CHtml::label('Project', ''); ?>
                <?php echo CHtml::openTag('span', array('id' => 'sale_order_header_project')); ?>
                <?php echo CHtml::encode(CHtml::value($budget->header, 'saleOrderHeader.project_name')); ?>
                <?php echo CHtml::closeTag('span'); ?>  
            </td>
        </tr>
        <tr>
            <td>
                <?php echo CHtml::label('Catatan', false); ?>
                <?php echo CHtml::activeTextArea($budget->header, 'note'); ?>
                <?php echo CHtml::error($budget->header, 'note'); ?>
            </td>
            <td>
                <?php echo CHtml::label('Company', ''); ?>
                <?php echo CHtml::openTag('span', array('id' => 'sale_order_header_company')); ?>
                <?php echo CHtml::encode(CHtml::value($budget->header, 'saleOrderHeader.client_company')); ?>
                <?php echo CHtml::closeTag('span'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo CHtml::label('Biaya', ''); ?>
                <?php echo CHtml::activeDropDownList($budget->header, 'budgeting_fee_id', CHtml::listData(BudgetingFee::model()->findAll(), 'id', 'name'), array('empty' => '-- Pilih Biaya --')); ?>
				<?php echo CHtml::error($budget->header, 'budgeting_fee_id'); ?>
				<?php echo CHtml::activeTextField($budget->header, 'budgeting_fee_value'); ?>
                <?php echo CHtml::error($budget->header, 'budgeting_fee_value'); ?>
            </td>
            <td>
                <?php echo CHtml::label('Client', ''); ?>
                <?php echo CHtml::openTag('span', array('id' => 'sale_order_header_client')); ?>
                <?php echo CHtml::encode(CHtml::value($budget->header, 'saleOrderHeader.client_name')); ?>
                <?php echo CHtml::closeTag('span'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo CHtml::label('Wiring Value', ''); ?>
                <?php echo CHtml::activeTextField($budget->header, 'wiring_value'); ?>
                <?php echo CHtml::error($budget->header, 'wiring_value'); ?>
            </td>
            <td>
                <?php echo CHtml::label('Accessories Value', ''); ?>
                <?php echo CHtml::activeTextField($budget->header, 'accessories_value'); ?>
                <?php echo CHtml::error($budget->header, 'accessories_value'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo CHtml::label('Overhead', ''); ?>
                <?php echo CHtml::activeTextField($budget->header, 'overhead_percentage'); ?>%
                <?php echo CHtml::error($budget->header, 'overhead_percentage'); ?>
            </td>
            <td>
                <?php echo CHtml::label(' Fee', ''); ?>
                <?php echo CHtml::activeTextField($budget->header, 'fee_percentage'); ?>%
                <?php echo CHtml::error($budget->header, 'fee_percentage'); ?>
            </td>
        </tr>
    </table>

    <div id="detail_div_currency">
        <?php $this->renderPartial('_detail_currency', array('budget' => $budget)); ?>
    </div>

    <div id="detail_div_brand_discount">
        <?php $this->renderPartial('_detail_brand_discount', array('budget' => $budget)); ?>
    </div>

    <div id="detail_div">
        <?php //$this->renderPartial('_detail', array('budget' => $budget)); ?>
    </div>

    <div id="detail_man">
        <?php //$this->renderPartial('_detail_panel', array('budget' => $budget)); ?>
    </div>

    <?php echo CHtml::submitButton('Submit', array('name' => 'save')); ?>

    <?php echo CHtml::endForm(); ?>
</div>

<!--Estimation Dialog-->
<?php
$this->beginwidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'sale-order-dialog',
    // Additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Sale Order',
        'autoOpen' => FALSE,
        'width' => 'auto',
        'modal' => TRUE,
    ),
));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'sale-order-grid',
    'dataProvider' => $saleOrderHeaderDataProvider,
    'filter' => $saleOrderHeader,
    'selectionChanged' => 'js:function(id){
        $("#' . CHtml::activeID($budget->header, 'sale_order_header_id') . '" ).val($.fn.yiiGridView.getSelection(id));

        $("#sale-order-dialog").dialog("close");
        if($.fn.yiiGridView.getSelection(id) == "")
        {
            $("#sale_order_header_number").html("");
            $("#sale_order_header_project").html("");
            $("#sale_order_header_company").html("");
            $("#sale_order_header_clent").html("");
            
        }
        else
        {
            $.ajax({
                type:"Post",
                dataType : "JSON",
                url : "' . CController::createurl('ajaxJsonBudget', array('id' => $budget->header->id)) . '",
                data : $("form").serialize(),
                success : function(data){
                    $("#sale_order_header_number").html(data.saleOrderNumber);
                    $("#sale_order_header_company").html(data.saleOrderCompany);
                    $("#sale_order_header_project").html(data.saleOrderProject);
                    $("#sale_order_header_client").html(data.saleOrderClient);
                },
            });

        }
    }',
    'columns' => array(
        array(
            'header' => 'Sale Order #',
            'filter' => CHtml::activeTextField($saleOrderHeader, 'cn_ordinal', array('style' => 'width: 50px;')) .
            ' / ' .
            SaleOrderHeader::CN_CONSTANT .
            ' / ' .
            CHtml::activeTextField($saleOrderHeader, 'cn_month', array('style' => 'width: 50px;')) .
            ' / ' .
            CHtml::activeTextField($saleOrderHeader, 'cn_year', array('style' => 'width: 50px;')),
            'value' => 'CHtml::encode($data->getCodeNumber(SaleOrderHeader::CN_CONSTANT))'
        ),
        'project_name',
        'client_company',
    ),
));
?>
<?php $this->endwidget('zii.widgets.jui.CJuiDialog'); ?>