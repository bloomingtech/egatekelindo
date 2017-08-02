<?php
Yii::app()->clientScript->registerCss('_report', '
	.width1-1 { width: 50% }
	.width1-2 { width: 15% }
	.width1-3 { width: 15% }
	.width1-4 { width: 20% }

	.width2-1 { width: 15% }
	.width2-2 { width: 25% }
	.width2-3 { width: 15% }
	.width2-4 { width: 15% }
	.width2-5 { width: 15% }
	.width2-6 { width: 15% }
');
?>

<div style="font-weight: bold; text-align: center">
    <div style="font-size: larger">Laporan Buku Besar</div>
    <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
    <tr id="header1">
        <th class="width1-1">Akun</th>
        <th class="width1-2">Total Debit</th>
        <th class="width1-3">Total Kredit</th>
        <th class="width1-4">Saldo Akhir</th>

    </tr>
    <tr id="header2">
        <td colspan="4">
            <table>
                <tr>
                    <th class="width2-1">Transaksi</th>
                    <th class="width2-2">Memo</th>
                    <th class="width2-3">Tanggal</th>
                    <th class="width2-4">Debet</th>
                    <th class="width2-5">Kredit</th>
                    <th class="width2-6">Saldo</th>
                </tr>
            </table>
        </td>
    </tr>
    <?php foreach ($generalLedgerSummary->dataProvider->data as $header): ?>
        <tr class="items1">
            <td><?php echo CHtml::encode(CHtml::value($header, 'code')); ?> - <?php echo CHtml::encode(CHtml::value($header, 'name')); ?></td>
            <td><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->getEndDebitLedger($header->id, $startDate, $endDate))); ?></td>
            <td><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->getEndCreditLedger($header->id, $startDate, $endDate))); ?></td>
            <td><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->getEndBalanceLedger($header->id, $endDate))); ?></td>
        </tr>
        <tr class="items2">
            <td colspan="4">
                <table>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td>Saldo awal</td>
                        <td><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->getBeginningBalanceLedger($header->id, $startDate))); ?></td>
                    </tr>
                    <?php foreach ($header->journalAccountings as $detail): ?>
                        <tr>
                            <td><?php echo CHtml::encode(CHtml::value($detail, 'transaction_number')); ?></td>
                            <td><?php echo CHtml::encode(CHtml::value($detail, 'memo')); ?></td>
                            <td style="text-align: center"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($detail->date))); ?></td>
                            <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->debit)); ?></td>
                            <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->credit)); ?></td>
                            <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->currentSaldo)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
    <?php endforeach; ?>
</table>