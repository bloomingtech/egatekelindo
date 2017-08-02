<?php
Yii::app()->clientScript->registerCss('_report', '
	.width1-1 { width: 10% }
	.width1-2 { width: 8% }
	.width1-3 { width: 10% }
	.width1-4 { width: 18% }
	.width1-5 { width: 15% }
        .width1-6 { width: 10% }
	.width1-7 { width: 7% }
	.width1-8 { width: 7% }
	.width1-9 { width: 8% }
	.width1-10 { width: 7% }

');
?>

<div style="font-weight: bold; text-align: center">
    <div style="font-size: larger"><?php echo Yii::app()->name; ?></div>
    <div style="font-size: larger">Laporan Sales Order</div>
    <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
    <tr id="header1">
        <th class="width1-1" style="text-align: left;border-bottom: 2px solid;">Nomor</th>
        <th class="width1-2" style="text-align: left;border-bottom: 2px solid;">Tanggal</th>
        <th class="width1-3" style="text-align: left;border-bottom: 2px solid;">No SO Sementara</th>
        <th class="width1-4" style="text-align: left;border-bottom: 2px solid;">Project</th>
        <th class="width1-5" style="text-align: left;border-bottom: 2px solid;">Client</th>
        <th class="width1-6" style="text-align: left;border-bottom: 2px solid;">Company</th>
        <th class="width1-7" style="text-align: left;border-bottom: 2px solid;">No SPK/PO</th>
        <th class="width1-8" style="text-align: right;border-bottom: 2px solid;">Value</th>
        <th class="width1-9" style="text-align: left;border-bottom: 2px solid;">Delivery Time</th>
        <th class="width1-10" style="text-align: right;border-bottom: 2px solid;">Personal Fee</th>

    </tr>

    <?php foreach ($saleOrderSummary->dataProvider->data as $header): ?>
        <tr class="items1">
            <td class="width1-1" style="text-align: left"><?php echo CHtml::encode($header->getCodeNumber(SaleOrder::CN_CONSTANT)); ?></td>
            <td class="width1-2"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
            <td class="width1-3" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'temporary_number')); ?></td>
            <td class="width1-4" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'project_name')); ?></td>
            <td class="width1-5" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'client_name')); ?></td>
            <td class="width1-6" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'client_company')); ?></td>
            <td class="width1-7" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'work_order_number')); ?></td>
            <td class="width1-8" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->value)); ?></td>
            <td class="width1-9"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->delivery_time))); ?></td>
            <td class="width1-10" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->personal_fee)); ?></td>     
        </tr>	
    <?php endforeach; ?>

</table>