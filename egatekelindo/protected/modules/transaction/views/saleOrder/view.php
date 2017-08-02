<?php
//$purchaseItem as a PurchaseHeader model

$this->breadcrumbs = array(
    'Sales Order' => array('/transaction/saleOrder/create'),
    'View',
);
?>

<style>
    table
    {
        margin-bottom: 0px;
    }
</style>

<?php if (Yii::app()->user->hasFlash('confirm')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('confirm'); ?>
    </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>

<h1>SALES ORDER<?php //echo $this->id . '/' . $this->action->id;              ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $saleOrder,
    'attributes' => array(
        array(
            'label' => 'Nomor #',
            'value' => $saleOrder->getNumber(SaleOrderHeader::CN_CONSTANT),
        ),
        array(
            'label' => 'Tanggal',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($saleOrder, 'date'))),
        ),
        array(
            'label' => 'Project Name',
            'value' => CHtml::encode(CHtml::value($saleOrder, 'project_name')),
        ),
        array(
            'label' => 'Client Name',
            'value' => CHtml::encode(CHtml::value($saleOrder, 'client_name')),
        ),
        array(
            'label' => 'Client Company',
            'value' => CHtml::encode(CHtml::value($saleOrder, 'client_company')),
        ),
        array(
            'label' => 'Telp',
            'value' => CHtml::encode(CHtml::value($saleOrder, 'phone')),
        ),
        array(
            'label' => 'Fax',
            'value' => CHtml::encode(CHtml::value($saleOrder, 'fax')),
        ),
        array(
            'label' => 'NO SPK / PO',
            'value' => CHtml::encode(CHtml::value($saleOrder, 'work_order_number')),
        ),
        array(
            'label' => 'Value',
            'value' => Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'value')),
        ),
        array(
            'label' => 'MOS',
            'value' => Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'material_on_site')),
        ),
        array(
            'label' => 'DP',
            'value' => Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'downpayment')),
        ),
        array(
            'label' => 'T & C',
            'value' => Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'testing')),
        ),
        array(
            'label' => 'Maintenance',
            'value' => Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'maintenance')),
        ),
        array(
            'label' => 'Delivery Time',
            'value' => CHtml::encode(CHtml::value($saleOrder, 'delivery_time')),
        ),
        array(
            'label' => 'Personal Fee',
            'value' => Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'personal_fee')),
        ),
        array(
            'label' => 'Margin',
            'value' => Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'margin')),
        ),
        array(
            'label' => 'Jesin SO',
            'value' => $saleOrder->is_temporary == 0 ? 'Real' : 'Sementara',
        ),
        array(
            'label' => 'Status',
            'value' => $saleOrder->orderStatus,
        ),
        array(
            'label' => 'Catatan',
            'value' => CHtml::encode(CHtml::value($saleOrder, 'note')),
        ),
    ),
));
?>
<br/>
<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th width="3%">No</th>
        <th>Panel Name</th>
        <th style="text-align: right">Quantity</th>
        <th style="text-align: right">Unit Price</th>
        <th style="text-align: right">Total</th>
        <th>&nbsp;</th>
    </tr>
    <?php foreach ($detailsDataProvider->data as $i => $detail) : ?>
        <tr>
            <td><?php echo $i + 1; ?></td>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'panel_name')); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'unit_price'))); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'total'))); ?></td>
            <td></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td style="border-top:1px solid;">&nbsp;</td>
        <td style="border-top:1px solid;">&nbsp;</td>
        <td style="border-top:1px solid;">&nbsp;</td>
        <td style="text-align: right;border-top:1px solid;font-weight: bold;" >Sub Total / DPP</td>
        <td style="text-align: right;border-top:1px solid;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($saleOrder, 'subTotal'))); ?></td>
        <td style="border-top:1px solid;"></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td style="text-align: right;font-weight: bold;">Discount <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($saleOrder, 'discount'))); ?> %</td>
        <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($saleOrder, 'discountValue'))); ?></td>
        <td></td>
    </tr>
    <?php if ($saleOrder->is_tax): ?>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="text-align: right;font-weight: bold;">PPN 10%</td>
            <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($saleOrder, 'ppn'))); ?></td>
            <td></td>
        </tr>
    <?php endif; ?>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td style="text-align: right;font-weight: bold;">Grand Total</td>
        <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($saleOrder, 'grandTotal'))); ?></td>
        <td></td>
    </tr>

</table>

<br />
<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Print', array('memo', 'id' => $saleOrder->id), array('target' => '_blank')); ?>
    <?php echo CHtml::link('Print All', array('memoAll', 'id' => $saleOrder->id), array('target' => '_blank')); ?>
    <?php //if ($saleOrder->estimationHeaders == NULL): ?>
        <?php echo CHtml::link('Update Panel', array('updatePanel', 'id' => $saleOrder->id), array('target' => '_blank')); ?>
    <?php //endif; ?>

</div>
<br/>

<div>
    <?php /*if ((int) $saleOrder->is_paid_downpayment === 0): ?>
        <div style="float: left;">
            <?php echo CHtml::beginForm(); ?>
            <?php echo CHtml::submitButton('INVOICE DP', array('name' => 'Submit', 'class' => 'btn-approve')); ?>
            <?php echo CHtml::endForm(); ?>
        </div>
    <?php endif; */?>

    <?php if ((int) $saleOrder->is_approved === 0): ?>
        <div style="float: left; margin-left: 20px;">
            <?php echo CHtml::beginForm(); ?>
            <?php echo CHtml::submitButton('APPROVE', array('name' => 'Approve', 'class' => 'btn-approve')); ?>
            <?php echo CHtml::endForm(); ?>
        </div>
    <?php endif; ?>
    <div class="clear"></div>
</div>