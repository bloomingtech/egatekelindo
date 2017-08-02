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

    .hcolumn1header { width: 35% }
    .hcolumn1value { width: 65% }
    .hcolumn2header { width: 35% }
    .hcolumn2value { width: 65% }

    .sig1 { width: 25% }
    .sig2 { width: 25% }
    .sig3 { width: 25% }
    .sig4 { width: 25% }
    
    .div-70 {width:70%; float:left}
    .div-30 {widht 30%; float:left}
    .div-50 {width:50%; float:left}
');
?>



<div id="memoheader">

</div>
<div class="div-separator-20">&nbsp;</div>

<div>
    <div class="div-70">
        <center>
            <div style="font-size: larger">PT. EGATEKELINDO</div>
            <div style="font-size: 2.5em">CU REQUIREMENT</div>
        </center>
        <br/>
        <table>
            <tr>
                <td>NAMA CLIENT</td>
                <td>:</td>
                <td><?php echo CHtml::encode(CHtml::value($requirement->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader, 'client_company')); ?></td>
                <td></td>
                <td>No. SPK Produksi</td>
                <td>:</td>
                <td><?php echo CHtml::encode($requirement->workOrderProductionHeader->getCodeNumber(WorkOrderProductionHeader::CN_CONSTANT)); ?></td>
            </tr>
            <tr>
                <td>NAMA PROYEK</td>
                <td>:</td>
                <td><?php echo CHtml::encode(CHtml::value($requirement->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader, 'project_name')); ?></td>
            </tr>
        </table>
    </div>
    <div class="div-30">
        <table>
            <tr>
                <td>No REQ</td>
                <td>:</td>
                <td><?php echo CHtml::encode($requirement->getCodeNumber($requirement->cnConstant)); ?></td>
            </tr>
            <tr>
                <td>BULAN</td>
                <td>:</td>
                <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('MMMM yyyy', strtotime(CHtml::value($requirement, 'date')))); ?></td>
            </tr>
            <tr>
                <td>No. SO</td>
                <td>:</td>
                <td><?php echo CHtml::encode($requirement->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)); ?></td>
            </tr>
        </table>
    </div>
    <div class="clear"></div>
</div>

<table class="memo">
    <tr id="theader">
        <th rowspan="3" style="vertical-align: middle">NO</th>
        <th rowspan="3" style="vertical-align: middle">TYPE </th>
        <th rowspan="3" style="vertical-align: middle">DESCRIPTION </th>
        <th colspan="<?php echo count($requirement->requirementDetails) ?>">NAMA PANEL </th>
        <th rowspan="2" colspan="2" style="vertical-align: middle">JUMLAH</th>
        <th rowspan="2" colspan="2" style="vertical-align: middle">STOCK</th>
        <th rowspan="2" colspan="2" style="vertical-align: middle">TOTAL YANG DIBELI</th>
        <th rowspan="3" style="vertical-align: middle">NO. PO </th>
        <th rowspan="3" style="vertical-align: middle">KETERANGAN </th>
    </tr>
    <tr id="theader">
        <?php foreach ($requirement->requirementDetails as $i => $detail): ?>
            <th><?php echo $detail->saleOrderDetail->panel_name; ?></th>
        <?php endforeach; ?>
    </tr>
    <tr id="theader">
        <?php foreach ($requirement->requirementDetails as $i => $detail): ?>
            <th>&nbsp;</th>
        <?php endforeach; ?>
        <th>METER</th>
        <th>BATANG</th>
        <th>METER</th>
        <th>BATANG</th>
        <th>METER</th>
        <th>BATANG</th>
    </tr>
    <?php foreach ($componentCus as $i => $componentCu): ?>
        <?php $totalCuRow = 0; ?>
        <tr class="titems">
            <td style="text-align: center;"><?php echo $i + 1; ?></td>
            <td><?php echo CHtml::encode(CHtml::value($componentCu, 'component_name')); ?></td>
            <td></td>
            <?php foreach ($requirement->requirementDetails as $i => $detailPanel): ?>
                <td style="text-align: center;"><?php echo $requirement->getTotalCuEachPanel($detailPanel, $componentCu); ?></td>
                <?php $totalCuRow+= $requirement->getTotalCuEachPanel($detailPanel, $componentCu); ?>
            <?php endforeach; ?>
            <td style="text-align: center;"><?php echo $totalCuRow; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
		<?php for ($j = 12, $i = $i % $j + 1; $j > $i; $j--): ?>
			<tr class="titems">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<?php foreach ($requirement->requirementDetails as $i => $detailPanel): ?>
					<td>&nbsp;</td>
				<?php endforeach; ?>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		<?php endfor; ?>
    <?php endforeach; ?>
</table>

<br />
<table class="memo">
    <tr id="theader">
        <th rowspan="4" style="text-align: left;">DELIVERY TIME :</th>
        <th colspan="6">DIPERIKSA</th>
        <th rowspan="2" style="vertical-align: middle">DISETEJUI</th>
        <th rowspan="2" style="vertical-align: middle">TOTAL HARGA</th>
    </tr>
    <tr id="theader">
        <th>KABAG DESIGN</th>
        <th>GUDANG</th>
        <th>PPIC</th>
        <th>OHD</th>
        <th>BC</th>
        <th>KEUANGAN</th>
    </tr>
    <tr id="theader">
        <th style="height: 60px">&nbsp;</th>
        <th >&nbsp;</th>
        <th >&nbsp;</th>
        <th >&nbsp;</th>
        <th >&nbsp;</th>
        <th >&nbsp;</th>
        <th >&nbsp;</th>
        <th rowspan="2">&nbsp;</th>
    </tr>
    <tr id="theader">
        <th  style="text-align: left;">DATE:</th>
        <th  style="text-align: left;">DATE:</th>
        <th  style="text-align: left;">DATE:</th>
        <th  style="text-align: left;">DATE:</th>
        <th  style="text-align: left;">DATE:</th>
        <th  style="text-align: left;">DATE:</th>
        <th  style="text-align: left;">DATE:</th>
    </tr>

</table>