<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'pendapatanexcel-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>
    <?php echo CHtml::errorSummary($saleOrder->header); ?>
    <div class="container">
        <div style="width: 50%; float:left;">
            <div class="row">
                <div class="label-form"><?php echo CHtml::label('Nomor #', false); ?></div>
                <div class="input-form">
                    <?php if ($saleOrder->header->isNewRecord) : ?>
                        <?php echo CHtml::activeTextField($saleOrder->header, 'cn_ordinal', array('size' => 10, 'maxlength' => 20)); ?>
                        <?php echo CHtml::error($saleOrder->header, 'cn_ordinal'); ?>
                        <?php echo CHtml::error($saleOrder->header, 'ordinal'); ?>
                    <?php else : ?>
                        <?php //echo CHtml::encode($saleOrder->header->getCodeNumber(SaleOrder::CN_CONSTANT)); ?>
                    <?php endif; ?>
                    <span id="header_code_number">
                        <?php echo CHtml::encode($saleOrder->header->getNumber(SaleOrderHeader::CN_CONSTANT)); ?>
                        <span>
                            </div>
                            <div class="clear"></div>
                            </div>

                            <div class="row">
                                <div class="label-form"><?php echo CHtml::label('PPN', ''); ?></div>
                                <div class="input-form">
                                    <?php if ($saleOrder->header->isNewRecord) : ?>
                                        <?php
                                        echo CHtml::activeDropDownList($saleOrder->header, 'is_tax', array(ActiveRecord::ACTIVE => 'NON-PPN', ActiveRecord::INACTIVE => 'PPN'), array(
                                            'onchange' => CHtml::ajax(array(
                                                'type' => 'POST',
                                                'dataType' => "JSON",
                                                'url' => CController::createUrl('ajaxJsonCodeNumber', array('id' => $saleOrder->header->id)),
                                                'success' => 'function(data) {
                                                    $("#header_code_number").html(data.codeNumber);

                                            }
                                            ',
                                            ))
                                        ));
                                        ?>
                                    <?php else : ?>
                                      <?php echo $saleOrder->header->is_tax ? 'PPN' : 'NON-PPN'; ?>
                                    <?php endif; ?>
                                </div>
                                <?php echo CHtml::error($saleOrder->header, 'is_tax'); ?>
                                <div class="clear"></div>
                            </div>

                            <div class="row">
                                <div class="label-form"><?php echo CHtml::label('Tanggal', false); ?></div>
                                <div class="input-form">
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'model' => $saleOrder->header,
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
                                </div>

                                <?php echo CHtml::error($saleOrder->header, 'date'); ?>
                                <div class="clear"></div>
                            </div>

                            <div class="row">
                                <div class="label-form"><?php echo CHtml::label('No SO Sementara', ''); ?></div>
                                <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'temporary_number'); ?></div>
                                <?php echo CHtml::error($saleOrder->header, 'temporary_number'); ?>
                                <div class="clear"></div>
                            </div>

                            <div class="row">
                                <div class="label-form"><?php echo CHtml::label('Project', ''); ?></div>
                                <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'project_name'); ?></div>
                                <?php echo CHtml::error($saleOrder->header, 'project_name'); ?>
                                <div class="clear"></div>
                            </div>

                            <div class="row">
                                <div class="label-form"><?php echo CHtml::label('Customer', ''); ?></div>
                                <div class="input-form">
                                    <?php
                                    echo CHtml::activeDropDownList($saleOrder->header, 'newCustomer', array(
                                        0 => 'Existing Customer',
                                        1 => 'New Customer'
                                            ), array(
                                        'onchange' => 'hideShowCustomer();'
                                    ));
                                    ?>

                                </div>

                                <div class="clear"></div>
                            </div>

                            <div id="existing_customer_div">
                                <div class="row">
                                    <div class="label-form"></div>
                                    <div class="input-form">
                                        <?php
                                        echo CHtml::activeTextField($saleOrder->header, 'customer_id', array(
                                            'readonly' => true,
                                            'onclick' => '$("#customer-dialog").dialog("open"); return false;',
                                            'onkeypress' => 'if (event.keyCode == 13) { $("#customer-dialog").dialog("open"); return false; }'));
                                        ?>
                                    </div>                       
                                    <div class="clear"></div>


                                    <div class="row">
                                        <div class="label-form"><?php echo CHtml::label('Client', ''); ?></div>
                                        <div class="input-form">
                                            <span id="customer_name">
                                                <?php echo CHtml::encode(CHtml::value($saleOrder->header, 'customer.name')); ?>
                                            </span>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="row">
                                        <div class="label-form"><?php echo CHtml::label('Company', ''); ?></div>
                                        <div class="input-form">
                                            <span id="customer_company">
                                                <?php echo CHtml::encode(CHtml::value($saleOrder->header, 'customer.commpany')); ?>
                                            </span>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="row">
                                        <div class="label-form"><?php echo CHtml::label('Phone', ''); ?></div>
                                        <div class="input-form">
                                            <span id="customer_phone">
                                                <?php echo CHtml::encode(CHtml::value($saleOrder->header, 'customer.phone')); ?>
                                            </span>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="row">
                                        <div class="label-form"><?php echo CHtml::label('Alamat', ''); ?></div>
                                        <div class="input-form">
                                            <span id="customer_address">
                                                <?php echo CHtml::encode(CHtml::value($saleOrder->header, 'customer.address')); ?>
                                            </span>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="row">
                                        <div class="label-form"><?php echo CHtml::label('NPWP', ''); ?></div>
                                        <div class="input-form">
                                            <span id="customer_tax_number">
                                                <?php echo CHtml::encode(CHtml::value($saleOrder->header, 'customer.tax_number')); ?>
                                            </span>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                </div>
                            </div>

                            <?php if ($saleOrder->header->isNewRecord): ?>
                                <div id="new_customer_div">

                                    <div class="row">
                                        <div class="label-form"><?php echo CHtml::label('Client', ''); ?></div>
                                        <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'client_name'); ?></div>
                                        <?php echo CHtml::error($saleOrder->header, 'client_name'); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="row">
                                        <div class="label-form"><?php echo CHtml::label('Company', ''); ?></div>
                                        <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'client_company'); ?></div>
                                        <?php echo CHtml::error($saleOrder->header, 'client_company'); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="row">
                                        <div class="label-form"><?php echo CHtml::label('Telp', ''); ?></div>
                                        <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'phone'); ?></div>
                                        <?php echo CHtml::error($saleOrder->header, 'phone'); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="row">
                                        <div class="label-form"><?php echo CHtml::label('Address', ''); ?></div>
                                        <div class="input-form"><?php echo CHtml::activeTextArea($saleOrder->header, 'address'); ?></div>
                                        <?php echo CHtml::error($saleOrder->header, 'address'); ?>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="row">
                                        <div class="label-form"><?php echo CHtml::label('NPWP', ''); ?></div>
                                        <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'tax_number'); ?></div>
                                        <?php echo CHtml::error($saleOrder->header, 'tax_number'); ?>
                                        <div class="clear"></div>
                                    </div>
                                </div><?php endif; ?>

                            <div class="row">
                                <div class="label-form"><?php echo CHtml::label('NO SPK / PO', ''); ?></div>
                                <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'work_order_number'); ?></div>
                                <?php echo CHtml::error($saleOrder->header, 'work_order_number'); ?>
                                <div class="clear"></div>
                            </div>

                            <!--                            <div class="row">
                                                            <div class="label-form"><?php //echo CHtml::label('VALUE', '');               ?></div>
                                                            <div class="input-form"><?php //echo CHtml::activeTextField($saleOrder->header, 'value');               ?></div>
                            <?php //echo CHtml::error($saleOrder->header, 'value'); ?>
                                                            <div class="clear"></div>
                                                        </div>-->
                            </div>

                            <div style="width:50%; float:left;">    


                                <!--        <div class="row">
                                            <div class="label-form"><?php //echo CHtml::label('Term of Payment', '');                             ?></div>
                                            <div class="input-form"><?php //echo CHtml::activeTextArea($saleOrder->header, 'payment_term', array('rows' => 5, 'cols' => 30));                             ?></div>
                                <?php //echo CHtml::error($saleOrder->header, 'payment_term');  ?>
                                            <div class="clear"></div>
                                        </div>-->

                                <div class="row">
                                    <div class="label-form"><?php echo CHtml::label('MOS (%)', ''); ?></div>
                                    <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'material_on_site'); ?></div>
                                    <?php echo CHtml::error($saleOrder->header, 'material_on_site'); ?>
                                    <div class="clear"></div>
                                </div>

                                <div class="row">
                                    <div class="label-form"><?php echo CHtml::label('DP (%)', ''); ?></div>
                                    <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'downpayment'); ?></div>
                                    <?php echo CHtml::error($saleOrder->header, 'downpayment'); ?>
                                    <div class="clear"></div>
                                </div>

                                <div class="row">
                                    <div class="label-form"><?php echo CHtml::label('T & C (%)', ''); ?></div>
                                    <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'testing'); ?></div>
                                    <?php echo CHtml::error($saleOrder->header, 'testing'); ?>
                                    <div class="clear"></div>
                                </div>

                                <div class="row">
                                    <div class="label-form"><?php echo CHtml::label('Retensi (%)', ''); ?></div>
                                    <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'maintenance'); ?></div>
                                    <?php echo CHtml::error($saleOrder->header, 'maintenance'); ?>
                                    <div class="clear"></div>
                                </div>

                                <div class="row">
                                    <div class="label-form"><?php echo CHtml::label('Discount (%)', ''); ?></div>
                                    <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'discount'); ?></div>
                                    <?php echo CHtml::error($saleOrder->header, 'discount'); ?>
                                    <div class="clear"></div>
                                </div>

                                <div class="row">
                                    <div class="label-form"><?php echo CHtml::label('Delivery Time', false); ?></div>
                                    <div class="input-form">
                                        <?php echo CHtml::activeTextField($saleOrder->header, 'delivery_time'); ?>
                                    </div>
                                    <?php echo CHtml::error($saleOrder->header, 'delivery_time'); ?>
                                    <div class="clear"></div>
                                </div>

                                <div class="row">
                                    <div class="label-form"><?php echo CHtml::label('Personal Fee', ''); ?></div>
                                    <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'personal_fee'); ?></div>
                                    <?php echo CHtml::error($saleOrder->header, 'personal_fee'); ?>
                                    <div class="clear"></div>
                                </div>

                                <div class="row">
                                    <div class="label-form"><?php echo CHtml::label('Margin', ''); ?></div>
                                    <div class="input-form"><?php echo CHtml::activeTextField($saleOrder->header, 'margin'); ?></div>
                                    <?php echo CHtml::error($saleOrder->header, 'margin'); ?>
                                    <div class="clear"></div>
                                </div>

                                <!--            <div class="row">
                                                <div class="label-form"><?php //echo CHtml::label('Jenis SO', '');                     ?></div>
                                                <div class="input-form">
    
                                <?php
//                echo CHtml::activeDropDownList($saleOrder->header, 'is_temporary', array(ActiveRecord::ACTIVE => 'Real', ActiveRecord::INACTIVE => 'Sementara'),        
//                        array(                    
//                            'onchange' =>CHtml::ajax(array(
//                            'type' => 'POST',
//                            'dataType' => "JSON",
//                            'url' => CController::createUrl('ajaxJsonCodeNumber', array('id' => $saleOrder->header->id)),
//                            'success' => 'function(data) {
//							$("#header_code_number").html(data.codeNumber);
//							
//						}
//						',
//                       
//                                ))
//                        ));
                                ?></div>
                                <?php //echo CHtml::error($saleOrder->header, 'is_temporary'); ?>
                                                <div class="clear"></div>
                                            </div>-->

                                <div class="row">
                                    <div class="label-form"><?php echo CHtml::label('Jenis SO', ''); ?></div>
                                    <div class="input-form">
                                        <?php
                                        echo CHtml::activeDropDownList($saleOrder->header, 'order_status', array(
                                            1 => SaleOrderHeader::ORDER_STATUS_CONST_1,
                                            2 => SaleOrderHeader::ORDER_STATUS_CONST_2,
                                            3 => SaleOrderHeader::ORDER_STATUS_CONST_3,
                                            4 => SaleOrderHeader::ORDER_STATUS_CONST_4
                                                )
                                        );
                                        ?></div>
                                    <?php echo CHtml::error($saleOrder->header, 'order_status'); ?>
                                    <div class="clear"></div>
                                </div>

                                <div class="row">
                                    <div class="label-form"><?php echo CHtml::label('Catatan', ''); ?></div>
                                    <div class="input-form"><?php echo CHtml::activeTextArea($saleOrder->header, 'note', array('rows' => 5, 'cols' => 30)); ?></div>
                                    <?php echo CHtml::error($saleOrder->header, 'note'); ?>
                                    <div class="clear"></div>
                                </div>

                            </div>
                            <div class="clear"></div>

                            </div>
                            <div class="row">
                                <?php echo CHtml::error($saleOrder->header, 'error'); ?>
                            </div>

                            <h1>Upload Detail</h1>
                            <div class="row">
                                <?php echo $form->labelEx($model, 'file_excel'); ?>
                                <?php echo $form->Filefield($model, 'file_excel'); ?>
                                <?php echo $form->error($model, 'file_excel'); ?>
                            </div>

                            <div class="row buttons">
                                <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?')); ?>
                            </div>

                            <?php $this->endWidget(); ?>

                            </div><!-- form -->

                            <script>
                                hideShowCustomer();

                                function hideShowCustomer() {
                                var customerDropDown = document.getElementById("SaleOrderHeader_newCustomer");
                                var existingCustomer = document.getElementById("existing_customer_div");
                                var newCustomer = document.getElementById("new_customer_div");

                                if (customerDropDown.value == 0) {
                                existingCustomer.style.display = 'block';
                                newCustomer.style.display = 'none';
                                }
                                else {
                                existingCustomer.style.display = 'none';
                                newCustomer.style.display = 'block';
                                }
                                }

                            </script>

                            <?php
                            $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                                'id' => 'customer-dialog',
// additional javascript options for the dialog plugin
                                'options' => array(
                                    'title' => 'Customer',
                                    'autoOpen' => false,
                                    'width' => 'auto',
                                    'modal' => true,
                                ),
                            ));
                            ?>
                            <?php
                            $this->widget('zii.widgets.grid.CGridView', array(
                                'id' => 'customer-grid',
                                'dataProvider' => $customerDataProvider,
                                'filter' => $customer,
                                'selectionChanged' => 'js:function(id) {
                                    $("#' . CHtml::activeId($saleOrder->header, 'customer_id') . '").val($.fn.yiiGridView.getSelection(id));
                                    $("#customer-dialog").dialog("close");
                                    if ($.fn.yiiGridView.getSelection(id) == "")
                                    {
                                            $("#customer_name").html("");
                                            $("#customer_company").html("");
                                            $("#customer_phone").html("");
                                            $("#customer_address").html("");
                                            $("#customer_tax_number").html("");
                                    }
                                    else
                                    {
                                            $.ajax({
                                                    type: "POST",
                                                    dataType: "JSON",
                                                    url: "' . CController::createUrl('ajaxJsonCustomer', array('id' => $saleOrder->header->id)) . '",
                                                    data: $("form").serialize(),
                                                    success: function(data) {
                                                            $("#customer_name").html(data.customerName);
                                                            $("#customer_company").html(data.customerCompany);
                                                            $("#customer_phone").html(data.customerPhone);
                                                            $("#customer_address").html(data.customerAddress);
                                                            $("#customer_tax_number").html(data.customerTaxNumber);
                                                    },
                                            });

                                    }
                            }',
                                'columns' => array(
                                    'name',
                                    'company',
                                    'address',
                                    'phone',
                                    'tax_number'
                                ),
                            ));
                            ?>
                            <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>