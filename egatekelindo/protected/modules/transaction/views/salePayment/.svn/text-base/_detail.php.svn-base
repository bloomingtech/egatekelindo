<?php echo CHtml::error($salePayment->header, 'error'); ?>

<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center; width: 10%">Invoice</th>
        <th style="text-align: center; width: 10%">Tanggal</th>
        <th style="text-align: center; width: 10%">Jml Invoice</th>
        <th style="text-align: center; width: 10%">No SO</th>
        <th style="text-align: center; width: 10%">Jmlh Bayar</th>
        <th style="text-align: center; width: 5%"></th>
    </tr>
    <?php foreach ($salePayment->details as $i => $detail): ?>
        <tr style="background-color: azure">
            <td>
                <?php echo CHtml::activeHiddenField($detail, "[$i]sale_invoice_header_id"); ?>
                <?php echo CHtml::link(CHtml::encode($detail->saleInvoiceHeader->getCodeNumber(SaleInvoiceHeader::CN_CONSTANT)), array('/transaction/saleInvoice/view', 'id' => $detail->saleInvoiceHeader->id)); ?>
            </td>
            <td>
                <?php echo CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", $detail->saleInvoiceHeader->date)); ?>
            </td>

            <td style="text-align: right">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail->saleInvoiceHeader, 'grand_total'))); ?>
            </td>
            <td>
                <?php echo CHtml::encode($detail->saleInvoiceHeader->deliveryHeader->saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)); ?>
            </td>

            <td style="text-align:right; width: 20%">
                <?php
                echo CHtml::activeTextField($detail, "[$i]amount", array(
                    'onchange' => CHtml::ajax(array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'url' => CController::createUrl('ajaxJsonTotal', array('id' => $salePayment->header->id, 'index' => $i)),
                        'success' => 'function(data) {
							$("#amount_' . $i . '").html(data.amount);
							$("#total_amount").html(data.totalAmount);
							$("#totalSaleReturn").html(data.totalSaleReturn);
							$("#grand_total").html(data.grandTotal);
						}',
                    )),
                ));
                ?>
                <div id="amount_<?php echo $i; ?>" style="text-align: right; font-size: smaller; margin-left: 15px;">
                    <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'amount'))); ?>
                </div>
                <?php echo CHtml::error($detail, 'amount'); ?>
            </td>

            <td>
                <?php if ($detail->isNewRecord): ?>
                    <?php
                    echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $salePayment->header->id, 'index' => $i)),
                            'update' => '#detail_div',
                        )),
                    ));
                    ?>
                <?php else: ?>
                    <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <tr style="background-color: aquamarine">
        <td colspan="4" style="text-align: right; font-weight: bold">Pembayaran:</td>
        <td style="text-align: right;font-weight: bold">
            <span id="total_amount">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salePayment, 'totalAmount'))); ?>
            </span>
        </td>
        <td></td>
    </tr>
    <tr style="background-color: aquamarine">
        <td colspan="4" style="text-align: right; font-weight: bold">Retur:</td>
        <td style="text-align: right; font-weight: bold">
            -<span id="totalSaleReturn">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salePayment->header->saleReturnHeader, 'grandTotal'))); ?>
            </span>
        </td>
        <td></td>
    </tr>
    <tr style="background-color: aquamarine">
        <td colspan="4" style="text-align: right; font-weight: bold">Grand Total:</td>
        <td style="text-align: right;font-weight: bold">
            <span id="grand_total">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salePayment, 'grandTotal'))); ?>
            </span>
        </td>
        <td></td>
    </tr>


</table>
<?php echo CHtml::hiddenField('ReturnChoosen'); ?>