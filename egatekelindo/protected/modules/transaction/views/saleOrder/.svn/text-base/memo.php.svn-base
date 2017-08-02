<?php
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

    .hcolumn1header { width: 35%; text-align: right }
    .hcolumn1value { width: 65% }
    .hcolumn2header { width: 35%; text-align: right }
    .hcolumn2value { width: 65% }

    .sig1 { width: 25% }
    .sig2 { width: 25% }
    .sig3 { width: 25% }
    .sig4 { width: 25% }
');
?>

<div id="memoheader">
	<table style="border: 1px solid">
		<tr>
			<td rowspan="2" style="width: 20%; font-weight: bold">PT. EGA TEKELINDO PRIMA</td>
			<td style="text-align: center; border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid; font-weight: bold">FORMULIR</td>
			<td style="width: 20%"></td>
		</tr>
		<tr>
			<td style="text-align: center; border-left: 1px solid; border-right: 1px solid; font-weight: bold">SALES ORDER</td>
			<td></td>
		</tr>
	</table>
</div>

<div class="width-20">
    <div class="float-left width-50">Nomor</div>
    <div class="float-left width-5">:</div>
    <div class="float-left font-bold"><?php echo CHtml::encode($saleOrder->getNumber(SaleOrderHeader::CN_CONSTANT)); ?></div>
    <div class="clear"></div>
    <div class="div-separator-5">&nbsp;</div>
    <div class="float-left  width-50">Tanggal</div>
    <div class="float-left width-5">:</div>
    <div class="float-left font-bold"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($saleOrder, 'date')))); ?></div>
    <div class="clear"></div>
    <div class="div-separator-5">&nbsp;</div>
    <div class="float-left  width-50">No SO Sementara</div>
    <div class="float-left width-5">:</div>
    <div class="float-left font-bold"><?php echo CHtml::encode(CHtml::value($saleOrder, 'temporary_number')); ?></div>
    <div class="clear"></div>
</div>

<div class="div-separator-20">&nbsp;</div>
<div class="div-separator-20">&nbsp;</div>

<div class="float-left width-12 font-bold">PROJECT</div>
<div class="float-left width-1">:</div>
<div class="float-left "><?php echo CHtml::encode(CHtml::value($saleOrder, 'project_name')); ?></div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">CLIENT OWNER</div>
<div class="float-left width-1">:</div>
<div class="float-left "><?php echo CHtml::encode(CHtml::value($saleOrder, 'client_name')); ?></div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">CONTRACTOR</div>
<div class="float-left width-1">:</div>
<div class="float-left "><?php echo CHtml::encode(CHtml::value($saleOrder, 'client_company')); ?></div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">CONSULTANT ME</div>
<div class="float-left width-1">:</div>
<div class="float-left "></div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">CONTACT</div>
<div class="float-left width-1">:</div>
<div class="float-left "></div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">TELP / FAX</div>
<div class="float-left width-1">:</div>
<div class="float-left ">
	<?php echo CHtml::encode(CHtml::value($saleOrder, 'phone')); ?> / 
	<?php echo CHtml::encode(CHtml::value($saleOrder, 'fax')); ?>
</div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">NO SPK / PO</div>
<div class="float-left width-1">:</div>
<div class="float-left "><?php echo CHtml::encode(CHtml::value($saleOrder, 'work_order_number')); ?></div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">VALUE</div>
<div class="float-left width-1">:</div>
<div class="float-left "><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'value'))); ?></div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">TERM OF PAYMENT</div>
<div class="float-left width-1">:</div>
<div class="float-left "> - MOS  <?php echo CHtml::encode(CHtml::value($saleOrder, 'material_on_site')); ?>%</div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">&nbsp;</div>
<div class="float-left width-1">&nbsp;</div>
<div class="float-left ">- TC  <?php echo CHtml::encode(CHtml::value($saleOrder, 'testing')); ?>%</div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">&nbsp;</div>
<div class="float-left width-1">&nbsp;</div>
<div class="float-left ">- RET  <?php echo CHtml::encode(CHtml::value($saleOrder, 'maintenance')); ?>%</div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">DP</div>
<div class="float-left width-1">:</div>
<div class="float-left "><?php echo CHtml::encode(CHtml::value($saleOrder, 'downpayment')); ?>%</div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">DELIVERY TIME</div>
<div class="float-left width-1">:</div>
<div class="float-left "><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($saleOrder, 'delivery_time')))); ?></div>
<div class="clear"></div>

<!--<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">PERSONAL FEE</div>
<div class="float-left width-1">:</div>
<div class="float-left "><?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'personal_fee'))); ?></div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">MARGIN</div>
<div class="float-left width-1">:</div>
<div class="float-left "><?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($saleOrder, 'margin'))); ?></div>
<div class="clear"></div>

<div class="div-separator-20">&nbsp;</div>
<div class="float-left width-12 font-bold">CATATAN</div>
<div class="float-left width-1">:</div>
<div class="float-left "><?php //echo CHtml::encode(CHtml::value($saleOrder, 'note')); ?></div>
<div class="clear"></div>-->


<div class="div-separator-20">&nbsp;</div>
<div class="div-separator-20">&nbsp;</div>

<div class="memosig">
    <div style="font-weight:bold; font-style: italic;" class="divtable">
        <div class="divtablecell sig2">
            <div>Prepared By,</div>
			<div style="height: 90px;"></div>
			<div>Wisnu</div>
        </div>
        <div class="divtablecell sig4">
            <div>Received By,</div>
			<div style="height: 90px;"></div>
			<div>OHD</div>
        </div>
		<div class="divtablecell sig3">
            <div>Diperiksa</div>
            <div style="height: 90px;"></div>
			<div>Invoicing &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ACC</div>
        </div>
        <div class="divtablecell sig1">
            <div>APPROVED</div>
            <div style="height: 90px;"></div>
			<div>Agatha C. H &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ir. Suhartono Hadiwarsito</div>
        </div>
    </div>
</div>
<br /><br />
<hr />

<div class="memonote">
    <div class="divtable">
        <div class="divtablecell hcolumn1">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Lembaran Putih</div>
                    <div class="divtablecell info hcolumn1value">: Accounting / BC</div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Merah</div>
                    <div class="divtablecell info hcolumn1value">: Finance</div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Kuning</div>
                    <div class="divtablecell info hcolumn1value">: OHD</div>
                </div>
				<div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Hijau</div>
                    <div class="divtablecell info hcolumn1value">: Arsip</div>
                </div>
            </div>
        </div>
        <div class="divtablecell hcolumn2">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Lampiran : </div>
                    <div class="divtablecell info hcolumn2value">(&nbsp;&nbsp;) PO dari Customer</div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold"></div>
                    <div class="divtablecell info hcolumn1value">(&nbsp;&nbsp;) RC Estimasi</div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold"></div>
                    <div class="divtablecell info hcolumn1value">(&nbsp;&nbsp;) Daftar Harga Putus / Penawaran Resmi Putus</div>
                </div>
            </div>
        </div>
    </div>
</div>
