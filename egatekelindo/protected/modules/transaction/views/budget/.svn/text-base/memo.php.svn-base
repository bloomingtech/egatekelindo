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
    <div style="font-size: larger">REKAPITULASI BUDGET</div>
    <div style="font-size: larger"><?php echo Yii::app()->name; ?></div>
    <div><?php echo CHtml::encode(CHtml::value($budget->header->saleOrderHeader, 'project_name')); ?></div>
    <div><?php echo CHtml::encode(CHtml::value($budget->header->saleOrderHeader, 'client_company')); ?></div>
    <div><?php echo CHtml::encode($budget->header->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)); ?></div>
</div>

<br />

<!--<div class="memonote">
    <div class="divtable">
        <div class="divtablecell hcolumn1">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Budget #</div>
                    <div class="divtablecell info hcolumn1value"><?php //echo CHtml::encode($budget->header->getCodeNumber(BudgetingHeader::CN_CONSTANT));                    ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal</div>
                    <div class="divtablecell info hcolumn1value"><?php //echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($budget->header, 'date'))));                    ?></div>
                </div>
                                <div class="divtablerow">
                                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Project</div>
                                    <div class="divtablecell info hcolumn1value"><?php // echo CHtml::encode(CHtml::value($budget->discounts,'project_name'));                       ?></div>
                                </div>
                                <div class="divtablerow">
                                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Company</div>
                                    <div class="divtablecell info hcolumn2value"><?php // echo CHtml::encode(CHtml::value($budget->discounts, 'client_company'));                       ?></div>
                                </div>
            </div>
        </div>
        <div class="divtablecell hcolumn2">
            <div class="divtable">
                                <div class="divtablerow">
                                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Name</div>
                                    <div class="divtablecell info hcolumn2value"><?php //echo CHtml::encode(CHtml::value($budget->discounts, 'client_name'));                       ?></div>
                                </div>
                                <div class="divtablerow">
                                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Currency Rate</div>
                                    <div class="divtablecell info hcolumn2value"><?php //echo CHtml::encode(CHtml::value($budget->discounts, 'currency_rate'));                       ?></div>
                                </div>
                                <div class="divtablerow">
                                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Currency</div>
                                    <div class="divtablecell info hcolumn2value"><?php //echo CHtml::encode(CHtml::value($budget->discounts, 'currency.name'));                       ?></div>
                                </div>
            </div>
        </div>
    </div>
</div>

<br />-->

<table class="memo">
    <tr id="theader">

        <th style="width: 5%">No.</th>
        <th style="width: 30%">Pekerjaan</th>
        <th style="width: 15%" colspan="2">Total R/C (ex ppn)</th>
        <th style="width: 15%" colspan="2">Harga Beli (ex ppn)</th>
        <th style="width: 15%" colspan="2">Selisih (excl ppn)</th>
        <th style="width: 20%">Keterangan</th>
    </tr>
    <?php $counter = 1; ?>
    <?php
    $grandTotalWithoutPpn = 0;
    $grandTotalWithPpn = 0;
    $grandTotalRCBeforeWiring = 0;
    $grandTotalBeforeWiring = 0;
    $grandTotalDifference = 0;
    ?>
    <?php foreach ($componentGroups as $componentGroup) : ?>
        <?php if ($componentGroup->id == 3): ?>
            <tr class="titems">
                <td style="text-align: center;"><?php echo $counter; $counter++; ?></td>
                <td><?php echo $componentGroup->name; ?></td>
                <td style="border-right: 0px solid;">Rp</td>
                <td style="border-left: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->getTotalComponentGroupWithoutPPn($componentGroup->id))); ?></td>
                <td style="border-right: 0px solid;">Rp</td>
                <td style="border-left: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->getTotalComponentGroupWithPPn($componentGroup->id))); ?></td>      
                <td style="border-right: 0px solid;">Rp</td>
                <td style="border-left: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->getTotalComponentDifference($componentGroup->id))); ?></td>
                <td></td>
            </tr>
        <?php endif; ?>
        <?php
        $grandTotalRCBeforeWiring += $budget->header->getTotalComponentGroupWithoutPPn($componentGroup->id);
        $grandTotalBeforeWiring += $budget->header->getTotalComponentGroupWithPPn($componentGroup->id);
        $grandTotalWithoutPpn+= $budget->header->getTotalComponentGroupWithoutPPn($componentGroup->id);
        $grandTotalWithPpn+= $budget->header->getTotalComponentGroupWithPPn($componentGroup->id);
        ?>
    <?php endforeach; ?>
			
    <?php foreach ($supportingComponents as $component) : ?>
       
        <tr class="titems">
            <td style="text-align: center;"><?php echo $counter; $counter++; ?></td>
            <td><?php echo $component->name; ?></td>
            <td style="border-right: 0px solid;">Rp</td>
            <td style="border-left: 0px solid;text-align: right;">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $component->getAllTotalWithoutPpn($budget->header->sale_order_header_id))); ?>
			</td>
            <td style="border-right: 0px solid;">Rp</td>
            <td style="border-left: 0px solid;text-align: right;">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $component->getAllTotalWithPpn($budget->header->id))); ?>
			</td>      
            <td style="border-right: 0px solid;">Rp</td>
            <td style="border-left: 0px solid;text-align: right;">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $component->getAllTotalDifference($budget->header->sale_order_header_id, $budget->header->id))); ?>
			</td>
            <td></td>
        </tr>
       
    <?php endforeach; ?>
		
    <?php foreach ($componentGroups as $componentGroup) : ?>
        <?php if ($componentGroup->id == 1 ): ?>
            <tr class="titems">
                <td style="text-align: center;"><?php echo $counter; $counter++; ?></td>
                <td><?php echo $componentGroup->name; ?></td>
                <td style="border-right: 0px solid;">Rp</td>
                <td style="border-left: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->getTotalComponentGroupWithoutPPn($componentGroup->id))); ?></td>
                <td style="border-right: 0px solid;">Rp</td>
                <td style="border-left: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->getTotalComponentGroupWithPPn($componentGroup->id))); ?></td>      
                <td style="border-right: 0px solid;">Rp</td>
                <td style="border-left: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->getTotalComponentDifference($componentGroup->id))); ?></td>
                <td></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>    
        
    <tr class="titems">
        <td style="text-align: center;"><?php echo $counter;
    $counter++; ?></td>
        <td>CU/BUSBAR</td>
        <td style="border-right: 0px solid;">Rp</td>
        <td style="border-left: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($budget->header, 'totalAllCuWithoutPPn'))); ?></td>
        <td style="border-right: 0px solid;">Rp</td>
        <td style="border-left: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($budget->header, 'totalAllCuWithPPn'))); ?></td>      
        <td style="border-right: 0px solid;">Rp</td>
        <td style="border-left: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($budget->header, 'totalAllCuDifference'))); ?></td>
        <td></td>
    </tr>
    <tr class="titems">
        <td style="text-align: center;"><?php echo $counter;
            $counter++; ?></td>
        <td>Acc</td>
        <td style="border-right: 0px solid;">Rp</td>
        <td style="border-left: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($budget->header, 'accessories_value'))); ?></td>
        <td style="border-right: 0px solid;">Rp</td>
        <td style="border-left: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($budget->header, 'accessories_value'))); ?></td>      
        <td style="border-right: 0px solid;">Rp</td>
        <td style="border-left: 0px solid;text-align: right;">-</td>
        <td></td>
    </tr>
    <tr class="titems">
        <td style="text-align: center;"><?php echo $counter;
            $counter++; ?></td>
        <td>Wiring</td>
        <td style="border-right: 0px solid;">Rp</td>
        <td style="border-left: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($budget->header, 'wiring_value'))); ?></td>
        <td style="border-right: 0px solid;">Rp</td>
        <td style="border-left: 0px solid;text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($budget->header, 'wiring_value'))); ?></td>      
        <td style="border-right: 0px solid;">Rp</td>
        <td style="border-left: 0px solid;text-align: right;">-</td>
        <td></td>
    </tr>
    <?php
    $grandTotalRCBeforeWiring += CHtml::value($budget->header, 'totalAllCuWithoutPPn') + CHtml::value($budget->header, 'accessories_value');
    $grandTotalBeforeWiring += CHtml::value($budget->header, 'totalAllCuWithPPn') + CHtml::value($budget->header, 'accessories_value');
    $grandTotalWithoutPpn+=CHtml::value($budget->header, 'totalAllCuWithoutPPn') + CHtml::value($budget->header, 'accessories_value') + CHtml::value($budget->header, 'wiring_value');
    $grandTotalWithPpn+=CHtml::value($budget->header, 'totalAllCuWithPPn') + CHtml::value($budget->header, 'accessories_value') + CHtml::value($budget->header, 'wiring_value');
    $grandTotalDifference = $grandTotalWithoutPpn - $grandTotalWithPpn;
    ?>
    <tr class="titems" style="background-color: #ddd;">
        <td></td>
        <td style="font-weight: bold;">TOTAL</td>
        <td style="border-right: 0px solid; font-weight: bold;">Rp</td>
        <td style="text-align: right; border-left: 0px solid; font-weight: bold;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $grandTotalWithoutPpn)); ?></td>
        <td style="border-right: 0px solid; font-weight: bold;">Rp</td>
        <td style="text-align: right; border-left: 0px solid;font-weight: bold;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $grandTotalWithPpn)); ?></td>
        <td style="border-right: 0px solid;font-weight: bold;">Rp</td>
        <td style="text-align: right; border-left: 0px solid;font-weight: bold;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $grandTotalDifference)); ?></td>
        <td>&nbsp;</td>
    </tr>
</table>
<table>
    <tr>
        <th style="width: 5%"></th>
        <th style="width: 30%">Nilai Kontrak</th>
        <th style="width: 15%" colspan="2"></th>
        <th></th>
        <th>Rp</th>
        <th style="width: 15%; text-align: right;" ><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->saleOrderHeader->valueWithoutTax)); ?></th>
        <th style="width: 15%; " colspan="2">(ex ppn)</th>
        <th style="width: 20%"></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th style="width: 15%; text-align: center;" colspan="2">RC</th>
        <th></th>
        <th style="width: 15%; text-align: center;" colspan="2">Harga Beli</th>
    </tr>
    <tr>
        <td></td>
        <td>Total harga sebelum wiring</td>
        <td>Rp</td>
        <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $grandTotalRCBeforeWiring)); ?></td> 
        <td></td>
        <td>Rp</td>
        <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $grandTotalBeforeWiring)); ?></td>  
    </tr>
    <tr>
        <td colspan="11">&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td>Laba kotor sebelum wiring</td>
        <td>Rp</td>
        <td style="width: 15%; text-align: right;" ><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->saleOrderHeader->value)); ?></td>
        <td>-</td>
        <td>Rp</td>
        <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $grandTotalBeforeWiring)); ?></td>  
        <td>Rp</td>
        <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->profitBeforeWiringValue)); ?></td>  
        <td style="text-align: right; width: 10%;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $budget->header->profitBeforeWiringPercentage)); ?>%</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td>Over head (<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->overhead_percentage)); ?>%)</td>
        <td colspan="2" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->overhead_percentage)); ?>%</td>
        <td>x</td>
        <td>Rp</td>
        <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->saleOrderHeader->value)); ?></td>
        <td>Rp</td>
        <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->overheadValue)); ?></td>
        <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->overhead_percentage)); ?>%</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td>Fee <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->fee_percentage)); ?>%</td>
        <td colspan="2" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->fee_percentage)); ?>%</td>
        <td>x</td>
        <td>Rp</td>
        <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->saleOrderHeader->value)); ?></td>
        <td>Rp</td>
        <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->feeValue)); ?></td>
        <td style="text-align: right; width: 10%;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->fee_percentage)); ?>%</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td>Ongkos Kirim</td>
        <td colspan="5">&nbsp;</td>
        <td style="border-bottom: 1px solid;">Rp</td>
        <td style="border-bottom: 1px double; text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->shipping_fee)); ?></td>
        <td style="text-align: right; width: 10%;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $budget->header->shippingFeePercentage)); ?>%</td>
        <td>&nbsp;</td>
    </tr>  
    <tr>
        <td></td>
        <td>Laba sesudah over head</td>
        <td colspan="5">&nbsp;</td>
        <td >Rp</td>
        <td style="text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $budget->header->profitAfterOverheadValue)); ?></td>
        <td style="text-align: right; width: 10%;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $budget->header->profitAfterOverheadPercentage)); ?>%</td>
        <td>&nbsp;</td>
    </tr>
</table>

<!--
<table class="memo">
    <tr id="theader">
        <th>Discount</th>
        <th style="width: 10%">Disc 1</th>
        <th style="width: 10%">type 1</th>
        <th style="width: 10%">Disc 2</th>
        <th style="width: 10%">type 2</th>
        <th style="width: 10%">Disc 3</th>
        <th style="width: 10%">type 3</th>
        <th style="width: 10%">Disc 4</th>
        <th style="width: 10%">type 4</th>
        <th style="width: 10%">Disc 5</th>
        <th style="width: 10%">type 5</th>
    </tr>
<?php //foreach ($budget->discounts as $discount):  ?>
        <tr class="titems">
            <td><?php //echo CHtml::encode(CHtml::value($discount, 'brand.name'));               ?></td>
            <td style="text-align: center"><?php //echo CHtml::encode(CHtml::value($discount, 'discount_value_1'));               ?></td>
            <td style="text-align: right"><?php //echo CHtml::encode(CHtml::value($discount, 'type1'));               ?></td>
            <td style="text-align: center"><?php //echo CHtml::encode(CHtml::value($discount, 'discount_value_2'));               ?></td>
            <td style="text-align: right"><?php //echo CHtml::encode(CHtml::value($discount, 'type2'));               ?></td>
            <td style="text-align: center"><?php //echo CHtml::encode(CHtml::value($discount, 'discount_value_3'));               ?></td>
            <td style="text-align: right"><?php //echo CHtml::encode(CHtml::value($discount, 'type3'));               ?></td>
            <td style="text-align: center"><?php //echo CHtml::encode(CHtml::value($discount, 'discount_value_4'));               ?></td>
            <td style="text-align: right"><?php //echo CHtml::encode(CHtml::value($discount, 'type4'));               ?></td>
            <td style="text-align: center"><?php //echo CHtml::encode(CHtml::value($discount, 'discount_value_5'));               ?></td>
            <td style="text-align: right"><?php //echo CHtml::encode(CHtml::value($discount, 'type5'));               ?></td>
        </tr>
<?php //endforeach; ?>
<?php //$i = 1; ?>
<?php //for ($j = 5, $i = $i % $j + 1; $j > $i; $j--):  ?>
        <tr class="titems">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
<?php //endfor;  ?>
</table>

<table class="memo">
    <tr id="theader">
        <th style="text-align: center">Panel</th>
        <th style="text-align: center">Name</th>
        <th style="text-align: center">Quantity</th>
        <th style="text-align: center">Unit Price</th>
        <th style="text-align: center">Accesories Main</th>
        <th style="text-align: center">Accesories Secondary</th>
        <th style="text-align: center">Total</th>
    </tr>

<?php //$lastId = ''; ?>
<?php //foreach ($budget->details as $i => $detail): ?>
<?php //$panelId = CHtml::value($detail, 'estimationComponent.estimation_panel_id');  ?>


<?php //if ($lastId !== $panelId && $lastId !== ''):  ?>
            <tr class="titems">
                <td style="border-top: thin solid ; "></td>
                <td style="border-top: thin solid ; "></td>
                <td style="border-top: thin solid ; "></td>
                <td style="border-top: thin solid ; "></td>
                <td style="border-top: thin solid ; "></td>
                <td style="border-top: thin solid ; "></td>
                <td style="border-top: thin solid ; "></td>
            </tr>
<?php //endif;  ?>


        <tr class="titems">
            <td>
<?php //if ($lastId !== $panelId): ?>
<?php //echo CHtml::encode(CHtml::value($detail, 'estimationComponent.estimationPanel.panel_name')); ?>
<?php //endif;  ?>
            </td>
            <td style="text-align: left"><?php //echo CHtml::encode(CHtml::value($detail, 'estimationComponent.component.name'));               ?></td>
            <td style="text-align: center"><?php //echo CHtml::encode(CHtml::value($detail, 'estimationComponent.quantity'));               ?></td>
            <td style="text-align: center"><?php //echo CHtml::encode(CHtml::value($detail, 'estimationComponent.unit_price'));               ?></td>
            <td style="text-align: center"><?php //echo CHtml::encode(CHtml::value($detail, 'estimationComponent.accesoriesIdMain.type'));               ?></td>
            <td style="text-align: center"><?php //echo CHtml::encode(CHtml::value($detail, 'estimationComponent.accesoriesIdSecondary.type'));               ?></td>
            <td style="text-align: right"><?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'estimationComponent.total')));               ?></td>
        </tr>
<?php //$lastId = $panelId; ?>
<?php //endforeach;  ?>
    <tr class="titems">
        <td style="border-top: 1px solid black; border-right: 0px;">&nbsp;</td>
        <td style="border-top: 1px solid black; border-right: 0px; border-left: 0px;">&nbsp;</td>
        <td style="border-top: 1px solid black; border-right: 0px; border-left: 0px;">&nbsp;</td>
        <td style="border-top: 1px solid black; border-right: 0px; border-left: 0px;">&nbsp;</td>
        <td style="border-top: 1px solid black; border-right: 0px; border-left: 0px;">&nbsp;</td>
        <td style="text-align: right; border-top: 1px solid black; border-left: 0px;">Sub Total</td>
        <td style="text-align: right; border-top: 1px solid black;"><?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($budget->header, 'estimationHeader.subTotal')));               ?></td>
    </tr>

</table>-->
<br/>
<div>
    Catatan:
    <?php echo CHtml::encode(CHtml::value($budget->header, 'note')); ?>
</div>

<br />

<div class="memosig">
    <div style="font-weight:bold; font-style: italic;" class="divtable">
        <div class="divtablecell sig1">
            <div></div>
            <div></div>
        </div>
        <div class="divtablecell sig2">
            <div>Disetujui,</div>
            <div style="height: 70px">&nbsp;</div>
            <div>(Suhartono Hadiwarsito) &nbsp;&nbsp;(Agatha C Hadiwarsito)</div>
        </div>
        <div class="divtablecell sig3">
            <div>Diperiksa,</div>
             <div style="height: 70px">&nbsp;</div>
            <div>(Indra P Hadiwarsito) </div>
        </div>
        <div class="divtablecell sig4">
            <div>Disusun Oleh,</div>
             <div style="height: 70px">&nbsp;</div>
            <div>(Desya Puspita A)</div>
        </div>
    </div>
</div>