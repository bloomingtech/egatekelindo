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
            <div style="font-size: larger">PT. EGA TEKELINDO</div>
            <div style="font-size: 2.5em">COMPONENT PURCHASING REQUIREMENT</div>
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
                <td><?php echo CHtml::encode($requirement->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)); ?></td>
            </tr>
        </table>
    </div>
    <div class="clear"></div>
</div>

<table class="memo">
    <tr id="theader">
        <th rowspan="3" style="vertical-align: middle">NO</th>
        <th rowspan="3" style="vertical-align: middle">NAMA KOMPONEN </th>
        <th rowspan="3" style="vertical-align: middle">TYPE </th>
        <th rowspan="2" colspan="2" style="vertical-align: middle">DELIVERY TIME KOMPONEN</th>
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
        <th>MULAI MASUK</th>
        <th>TERAKHIR MASUK</th>
        <?php foreach ($requirement->requirementDetails as $i => $detail): ?>
            <th>&nbsp;</th>
        <?php endforeach; ?>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($components as $i => $component): ?>
        <?php $totalRow = 0; ?>
		<?php $totalStock = 0; ?>
		<?php $totalPurchase = 0; ?>
        <tr class="titems">
            <td style="text-align: center;"><?php echo $i + 1; ?></td>
            <td><?php echo CHtml::encode(CHtml::value($component, 'component_name')); ?></td>
            <td><?php echo CHtml::encode(CHtml::value($component, 'budgetingDetail.type')); ?></td>
            <td></td>
            <td></td>
            <?php foreach ($requirement->requirementDetails as $i => $detailPanel): ?>
                <td style="text-align: center;">
					<?php echo $requirement->getTotalComponentEachPanel($detailPanel, $component); ?>
				</td>
                <?php $totalRow+= $requirement->getTotalComponentEachPanel($detailPanel, $component); ?>
            <?php endforeach; ?>
            <td style="text-align: center;"><?php echo $totalRow; ?></td>
            <td></td>
            <?php foreach ($requirement->requirementDetails as $i => $detailPanel): ?>
				<?php $requirement->getTotalComponentStockEachPanel($detailPanel, $component); ?>
				<?php $totalStock+= $requirement->getTotalComponentStockEachPanel($detailPanel, $component); ?>
            <?php endforeach; ?>
			<td style="text-align: center;">
				<?php echo $totalStock; ?>
			</td>
            <td></td>
            <?php foreach ($requirement->requirementDetails as $i => $detailPanel): ?>
				<?php $requirement->getTotalComponentPurchaseEachPanel($detailPanel, $component); ?>
                <?php $totalPurchase+= $requirement->getTotalComponentPurchaseEachPanel($detailPanel, $component); ?>
            <?php endforeach; ?>
			<td style="text-align: center;">
				<?php echo $totalPurchase; ?>
			</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php endforeach; ?>
	<?php for ($j = 12, $i = $i % $j + 1; $j > $i; $j--): ?>
		<tr class="titems">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
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
</table>

<br />

<table class="memo">
    <tr id="theader">
        <th rowspan="3" style="text-align: left;">NOTE :</th>
        <th rowspan="2" style="vertical-align: middle">DIBUAT</th>
        <th rowspan="2" style="vertical-align: middle">DIPERIKSA</th>
        <th colspan="5">DIPERIKSA</th>
        <th rowspan="2" style="vertical-align: middle">DISETEJUI</th>
        <th rowspan="2" style="vertical-align: middle">FILE</th>
    </tr>
    <tr id="theader">
        <th>PPIC</th>
        <th>GUDANG</th>
        <th>OHD</th>
        <th>BC</th>
        <th>KEUANGAN</th>
    </tr>
    <tr id="theader">
        <th rowspan="3"></th>
        <th rowspan="3"></th>
        <th rowspan="3"></th>
        <th rowspan="3"></th>
        <th rowspan="3"></th>
        <th rowspan="3"></th>
        <th rowspan="3"></th>
        <th rowspan="3"></th>
        <th>&nbsp;</th>
    </tr>
    <tr id="theader">
        <th rowspan="3"  style="text-align: left;">DELIVERY PANEL :</th>
        <th>&nbsp;</th>
    </tr>
    <tr id="theader">
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
        <th  style="text-align: left;">DATE:</th>
    </tr>

</table>
<!--
<div class="memoCatatan">Catatan: <?php //echo CHtml::encode(CHtml::value($requirement, 'note'));                 ?></div>

<div class="memosig">
    <div style="font-weight:bold; font-style: italic;" class="divtable">
        <div  class="divtablecell sig2">
            <div></div>
            <div style="height: 50px;"></div>
            <div><?php //echo CHtml::encode(CHtml::value($purchaseItem, 'employeeIdAuthorized.name'));                             ?></div>
        </div>
        <div  class="divtablecell sig2">
            <div></div>
            <div style="height: 50px;"></div>
            <div><?php //echo CHtml::encode(CHtml::value($purchaseItem, 'employeeIdAuthorized.name'));                             ?></div>
        </div>
        <div  class="divtablecell sig3">
            <div></div>
            <div style="height: 50px;"></div>
            <div><?php //echo CHtml::encode(CHtml::value($purchaseItem, 'employeeIdApproved.name'));                             ?></div>
        </div>
        <div class="divtablecell sig4">
            <div >Tangerang, <?php //echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($requirement, 'date'))));                 ?></div>
            <div style="height: 50px;"></div>
            <div>( ____________________________ )</div>
        </div>
    </div>
</div>-->
