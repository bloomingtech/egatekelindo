<?php
Yii::app()->clientScript->registerCss('_report', '
	.width1-1 { width: 20% }
	.width1-2 { width: 20% }
	.width1-3 { width: 20% }
	.width1-4 { width: 20% }
	.width1-5 { width: 20% }
        

	.width2-1 { width: 10% }
	.width2-2 { width: 20% }
	.width2-3 { width: 10% }
	.width2-4 { width: 5% }
	.width2-5 { width: 10% }
	.width2-6 { width: 10% }
	.width2-7 { width: 5% }
	.width2-8 { width: 13% }
	.width2-9 { width: 13% }
	.width2-10 { width: 2% }
	.width2-11 { width: 2% }
');
?>

<div style="font-weight: bold; text-align: center">
    <div style="font-size: larger"><?php echo Yii::app()->name; ?></div>
    <div style="font-size: larger">Laporan Pengeluraran Barang Produksi</div>
    <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
    <tr id="header1">
        <th class="width1-1" style="text-align: left">Tanggal</th>
        <th class="width1-2" style="text-align: left">Material Checkout #</th>
        <th class="width1-3" style="text-align: left">Packing List #</th>
        <th class="width1-4" style="text-align: left">Tanggal Packing List</th>
        <th class="width1-5" style="text-align: left">Catatan</th>
    </tr>
    <tr id="header2">
        <td colspan="5">
            <table>
                <tr>
                    <th class="width2-1" style="text-align: left">Nama Barang</th>
                    <th class="width2-2" style="text-align: left">Brand</th>
                    <th class="width2-3" style="text-align: right">Quantity</th>
                </tr>
            </table>
        </td>
    </tr>
    <?php foreach ($materialCheckoutSummary->dataProvider->data as $header): ?>
        <tr class="items1">
            <td class="width1-1"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
            <td class="width1-2" style="text-align: left"><?php echo CHtml::encode($header->getCodeNumber(MaterialCheckoutHeader::CN_CONSTANT)); ?></td>
            <td class="width1-3" style="text-align: left"><?php echo CHtml::encode($header->packingListHeader->getCodeNumber(PackingListHeader::CN_CONSTANT)); ?></td>
            <td class="width1-4" style="text-align: left"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->packingListHeader->date))); ?></td>
            <td class="width1-5" style="text-align: left"><?php echo CHtml::encode(CHtml::value($header, 'note')); ?></td>
        </tr>
        <tr class="items2">
            <td colspan="5">
                <table>
                    <?php foreach ($header->materialCheckoutDetails as $detail): ?>
                        <tr>
                            <td class="width2-1" style="text-align: left"><?php echo CHtml::encode(CHtml::value($detail, 'packingListDetail.partListDetail.component.name')); ?></td>
                            <td class="width2-2" style="text-align: left"><?php echo CHtml::encode(CHtml::value($detail, 'packingListDetail.partListDetail.component.brand.name')); ?></td>
                            <td class="width2-3" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->quantity)); ?></td>
                        </tr>
                    <?php endforeach; ?>

                </table>
            </td>
        </tr>
    <?php endforeach; ?>
</table>