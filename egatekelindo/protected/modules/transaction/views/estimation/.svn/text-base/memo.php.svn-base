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
	.si43 { width: 25% }
');
?>

<div id="memoheader">
    <div style="font-size: larger"><?php echo Yii::app()->name; ?></div>
    <div>Testing alamat</div>
    <div style="font-size: larger">Estimasi</div>
</div>

<br />

<div class="memonote">
    <div class="divtable">
        <div class="divtablecell hcolumn1">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Purchase #</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode($estimation->header->getCodeNumber($estimation->header->cn_initial)); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($estimation->header, 'date')))); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Project</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($estimation->header, 'project_name')); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Company</div>
                    <div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($estimation->header, 'client_company')); ?></div>
                </div>
            </div>
        </div>
        <div class="divtablecell hcolumn2">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Name</div>
                    <div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($estimation->header, 'client_name')); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Currency Rate</div>
                    <div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($estimation->header, 'currency_rate')); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Currency</div>
                    <div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($estimation->header, 'currency.name')); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<br />

<table class="memo">
    <tr id="theader">
        <th style="width: 10%">Brand</th>
        <th style="width: 10%">Value 1</th>
        <th style="width: 10%">Value 2</th>
        <th style="width: 10%">Value 3</th>
<!--        <th style="width: 10%">Value 4</th>
        <th style="width: 10%">Value 5</th>-->
        <th style="width: 10%">Currency</th>
    </tr>
    <?php
    $estimationDetails = $estimation->details;

    foreach ($estimationDetails as $i => $detail)
        $estimationDetails[$i]->isPrimary = $detail->componentBrandDiscount->is_primary;

    usort($estimationDetails, function ($a, $b) {
                if ($a['isPrimary'] == $b['isPrimary'])
                    return 0;
                return ($a['isPrimary'] < $b['isPrimary']) ? 1 : -1;
            });
    ?>
    <?php $currentIsPrimary = NULL; ?>
    <?php foreach ($estimationDetails as $detail): ?>
        <?php if ($detail->isPrimary != $currentIsPrimary && $currentIsPrimary != NULL) : ?>
            <tr class="titems">
                <td colspan="5" style="border-top: 1px solid;">&nbsp;</td>
            </tr>
            <tr class="titems">
                <td colspan="5" style="border-bottom: 1px solid;font-weight: bold;">Komponen Pendukung</td>
            </tr>
        <?php endif; ?>
        <?php if ($currentIsPrimary == NULL): ?>
            <tr class="titems">
                <td colspan="5" style="border-bottom: 1px solid;font-weight: bold;">Komponen Utama</td>
            </tr>
        <?php endif; ?>
        <tr class="titems">
            <td><?php echo CHtml::encode(CHtml::value($detail, 'name')); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'value_1')); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'value_2')); ?></td>
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'value_3')); ?></td>
<!--            <td style="text-align: right"><?php //echo CHtml::encode(CHtml::value($detail, 'value_4')); ?></td>
            <td style="text-align: right"><?php //echo CHtml::encode(CHtml::value($detail, 'value_5')); ?></td>-->
            <td style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'estimationCurrency.value')); ?></td>

        </tr>
         <?php $currentIsPrimary = $detail->isPrimary; ?>
    <?php endforeach; ?>
    
</table>

<table class="memo">
    <tr id="theader">
        <th>Panel Name</th>
        <th style="text-align: center">Name</th>
        <th style="text-align: center">Weight</th>
        <th style="text-align: center">Quantity</th>
        <th style="text-align: center">Unit Price</th>
        <th style="text-align: center">Basic Price</th>
		<th style="text-align: center">Total</th>
        <th style="text-align: center">Accesories Phase</th>
        <th style="text-align: center">Accesories Value</th>
    </tr>

    <?php foreach ($estimation->panels as $panel): ?>
        <?php $lastId = ''; ?>
        <?php foreach ($panel->estimationComponents as $detail): ?>
            <?php $panelId = CHtml::value($panel, 'id'); ?>


            <?php if ($lastId !== $panelId): ?>
                <tr class="titems">
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                </tr>
            <?php endif; ?>

            <tr class="titems">
                <td>
                    <?php if ($lastId !== $panelId): ?>
                        <?php echo CHtml::encode(CHtml::value($detail, 'estimationPanel.panel_name')); ?>
                    <?php endif; ?>
                </td>
                
                <td style="text-align: left"><?php echo CHtml::encode(CHtml::value($detail, 'component.name')); ?></td>
                <td></td>
                <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'quantity')); ?></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'unit_price'))); ?></td></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'basicPriceOnly'))); ?></td>
		<td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'totalOnly'))); ?></td>
                <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'accesoriesPhase.nameFull')); ?></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'accesories_phase_value'))); ?></td>
            </tr>
            <?php $lastId = $panelId; ?>
        <?php endforeach; ?>
           <tr class="titems">
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
           </tr>  
        <?php foreach ($panel->estimationComponentAccesories as $detailAccesories): ?>
            <tr class="titems">
                <td></td>
                <td style="text-align: left">
                    <?php if($detailAccesories->component_id != NULL) : ?>
                        <?php echo CHtml::encode(CHtml::value($detailAccesories, 'component.name')); ?>
                    <?php else: ?>
                        <?php echo CHtml::encode(CHtml::value($detailAccesories, 'componentCu.name')); ?>
                    <?php endif; ?>
                </td>
                <td style="text-align: right">
                    <?php if($detailAccesories->component_cu_id != NULL): ?>
                        <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detailAccesories, 'weight'))); ?>
                    <?php endif;?>
                </td>
                <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detailAccesories, 'quantity')); ?></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detailAccesories, 'unit_price'))); ?></td></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detailAccesories, 'basicPriceOnly'))); ?></td>
		<td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detailAccesories, 'totalOnly'))); ?></td>
                <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detailAccesories, 'accesoriesPhase.nameFull')); ?></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detailAccesories, 'accesories_phase_value'))); ?></td>
            </tr>    
            
        <?php endforeach; ?>
        <tr class="titems">
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; " colspan="4"></td>
                    <td style="border-top: thin solid ; "></td>
                    <td style="border-top: thin solid ; " colspan="2"></td>
        </tr>  
           
        <tr class="titems">
            <td></td>
            <td>Total Cu</td>
            <td colspan="4"></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($panel, 'subTotalCu'))); ?></td>
            <td colspan="2"></td>
        </tr> 
        <tr class="titems">
            <td></td>
            <td>Accesories</td>
            <td colspan="4"></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($panel, 'subTotalAccesoriesPhase'))); ?></td>
            <td colspan="2"></td>
        </tr> 
        <tr class="titems">
            <td></td>
            <td>Wiring</td>
            <td colspan="4"></td>
            <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($panel, 'subTotalWiring'))); ?></td>
            <td colspan="2"></td>
        </tr>
        <tr class="titems">
            <td style="border-top: 1px solid;"></td>
            <td style="border-top: 1px solid;font-weight: bold;">TOTAL PANEL</td>
            <td colspan="4" style="border-top: 1px solid;"></td>
            <td style="text-align: right;border-top: 1px solid;font-weight: bold;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($panel, 'grandTotal'))); ?></td>
            <td colspan="2" style="border-top: 1px solid;"></td>
        </tr>
    <?php endforeach; ?>
    <tr class="titems">
        <td style="border-top: 1px solid black; border-right: 0px;">&nbsp;</td>
        <td style="border-top: 1px solid black; border-right: 0px; border-left: 0px;">&nbsp;</td>
        <td style="border-top: 1px solid black; border-right: 0px; border-left: 0px;">&nbsp;</td>
        <td style="border-top: 1px solid black; border-right: 0px; border-left: 0px;">&nbsp;</td>
        <td style="border-top: 1px solid black; border-right: 0px; border-left: 0px;">&nbsp;</td>
        <td style="border-top: 1px solid black; border-right: 0px; border-left: 0px;">&nbsp;</td>
        <td style="border-top: 1px solid black; border-right: 0px; border-left: 0px;">&nbsp;</td>
        <td style="text-align: right; border-top: 1px solid black; border-left: 0px;">Sub Total</td>
        <td style="text-align: right; border-top: 1px solid black;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($estimation->header, 'subTotal'))); ?></td>
    </tr>

</table>

<div>
    Catatan:
    <?php echo CHtml::encode(CHtml::value($estimation, 'note')); ?>
</div>

<br />

<div class="memosig">
    <div style="font-weight:bold; font-style: italic; border-left:2px solid; border-right:2px solid; border-bottom:2px solid; border-top:2px solid" class="divtable">
        <div class="divtablecell sig1">
            <div>Estimasi,</div>
            <div></div>
        </div>
        <div class="divtablecell sig2">
            <div>Mengetahui,</div>
            <div></div>
        </div>
        <div class="divtablecell sig3">
            <div>Disetujui,</div>
            <div></div>
        </div>
        <div class="divtablecell sig4">
            <div>Supplier,</div>
            <div></div>
        </div>
    </div>
</div>