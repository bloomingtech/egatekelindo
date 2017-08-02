<?php
//$sale as SaleHeader model

Yii::app()->clientScript->registerScript('memo', '
    $("#header").addClass("hide");
    $("#mainmenu").addClass("hide");
    $(".breadcrumbs").addClass("hide");
    $("#footer").addClass("hide");
');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/transaction/memo.css');
Yii::app()->clientScript->registerCss('memo', '
    .hcolumn1 { width: 50% }
    .hcolumn2 { width: 50% }

    .hcolumn1header { width: 35% }
    .hcolumn1value { width: 65% }
    .hcolumn2header { width: 35% }
    .hcolumn2value { width: 65% }

    .sig1 { width: 25% }
    .sig2 { width: 25% }
    .sig3 { width: 25% }
	.sig4 { width: 25% }
');
?>

<div id="memoheader">
    <div style="font-size: larger">PT EGATEKELINDO</div>
    <div style="font-size: 2.5em">SUBCON REQUEST</div>
</div>

<br />

<div class="memonote">
    <div class="divtable">
        <div class="divtablecell hcolumn1">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Subcon Request #</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode($subconRequest->getCodeNumber(SubconRequestHeader::CN_CONSTANT)); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($subconRequest, 'date')))); ?></div>
                </div>
            </div>
        </div>
        <div class="divtablecell hcolumn2">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Sales Order #</div>
                    <div class="divtablecell info hcolumn2value"><?php echo CHtml::encode($subconRequest->saleOrder->getCodeNumber(SaleOrder::CN_CONSTANT)); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Tanngal Order</div>
                    <div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($subconRequest, 'saleOrder.date')))); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<br />

<table class="memo">
    <tr id="theader">
        <th>Nama Barang</th>
        <th style="width: 25%">Brand</th>
        <th style="width: 5%">Jumlah</th>
    </tr>
    <?php foreach ($subconRequest->subconRequestDetails as $i => $detail): ?>
        <tr class="titems">
            <td style="text-align: left"><?php echo CHtml::encode(CHtml::value($detail, 'component.name')); ?></td>
            <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'component.componentBrand.name')); ?></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?></td>
        </tr>
    <?php endforeach; ?>
    <?php for ($j = 12, $i = $i % $j + 1; $j > $i; $j--): ?>
        <tr class="titems">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    <?php endfor; ?>

</table>

<div class="memoCatatan">Catatan: <?php echo CHtml::encode(CHtml::value($subconRequest, 'note')); ?></div>

