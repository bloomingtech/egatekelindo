<?php
Yii::app()->clientScript->registerScript('memo', '
    $("#header").addClass("hide");
    $("#mainmenu").addClass("hide");
    $(".breadcrumbs").addClass("hide");
    $("#footer").addClass("hide");
');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/transaction/memo.css');
Yii::app()->clientScript->registerCss('memo', '
    @page {
                size:auto;
                margin: 5px 0px 0px 0px;
            } 
            
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
    
    table{
      border-collapse: collapse;
    }
      
    table, td, th {
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        padding : 5px;
    }
');
?>

<table>
    <tr>
        <td colspan="2" rowspan="4" style="text-align: center; font-weight: bold;">PT EGA TEKELINDO PRIMA</td>
        <td colspan="4" rowspan="2" style="text-align: center;">FORMULIR</td>
        <td>No Dokumen</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>No Revisi</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="4" rowspan="2" style="font-weight: bold;text-align: center;">SURAT PERINTAH KERJA (SPK) GAMBAR</td>
        <td>Tanggal Terbit</td>
        <td width="10%">&nbsp;</td>
    </tr>
    <tr>
        <td>Halaman</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="6" style="border-right: 1px solid transparent !important; border-bottom: 2px solid transparent !important;">Jakarta : <?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($workOrderDrawing, 'date')))); ?> </td>
        <td colspan="2" style="border-bottom: 2px solid transparent !important;">No : <?php echo CHtml::encode($workOrderDrawing->getCodeNumber(WorkOrderDrawingHeader::CN_CONSTANT)); ?></td>
    </tr>
    <tr>
        <td colspan="8" style="border-top: 2px solid transparent !important; border-bottom: 2px solid transparent !important;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="8" style="border-top: 2px solid transparent !important; border-bottom: 2px solid transparent !important; ">Dengan Hormat,</td>
    </tr>
    <tr>
        <td colspan="8" style="border-top: 2px solid transparent !important">Diminta segera melaksanakan pekerjaan sesuai dengan tabel dibawah ini:</td>
    </tr>
    <tr>
        <td colspan="6" style="border-right: 1px solid transparent !important; border-bottom: 2px solid transparent !important;">LANGGANAN : <?php echo CHtml::encode(CHtml::value($workOrderDrawing->budgetingHeader->saleOrderHeader, 'client_company')); ?></td>
        <td colspan="2" style="border-bottom: 2px solid transparent !important;">UP : <?php echo CHtml::encode(CHtml::value($workOrderDrawing, 'order_to')); ?></td>
    </tr>
    <tr>
        <td colspan="8" style="border-top: 2px solid transparent !important; border-bottom: 2px solid transparent !important;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="6" style="border-top: 2px solid transparent !important;border-right: 1px solid transparent !important; border-bottom: 2px solid transparent !important;">PROYEK : <?php echo CHtml::encode(CHtml::value($workOrderDrawing->budgetingHeader->saleOrderHeader, 'project_name')); ?></td>
        <td colspan="2" style="border-top: 2px solid transparent !important; border-bottom: 2px solid transparent !important;">CC : <?php echo CHtml::encode(CHtml::value($workOrderDrawing, 'order_to_copy')); ?></td>
    </tr>
    <tr>
        <td colspan="8" style="border-top: 2px solid transparent !important;border-bottom: 2px solid transparent !important;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="8" style="border-top: 2px solid transparent !important;">NO ORDER : <?php echo CHtml::encode($workOrderDrawing->budgetingHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)); ?></td>
    </tr>
    <tr>
        <td style="text-align: center" width="5%">NO</td>
        <td style="text-align: center" colspan="3" width="8%">NAMA PANEL</td>
        <td style="text-align: center" width="20%">GAMBAR SELESAI</td>
        <td style="text-align: center" width="15%">NOTE</td>
        <td style="text-align: center" colspan="2" width="25%">KETERANGAN</td>
    </tr>
    <?php foreach ($workOrderDrawing->workOrderDrawingDetails as $i => $detail) : ?>
        <tr style="line-height: 25px;">
            <td style="text-align: center"><?php echo $i + 1; ?></td>
            <td colspan="3"><?php echo CHtml::encode(CHtml::value($detail->saleOrderDetail, 'panel_name')); ?></td>
            <td style="text-align: center;"><?php echo Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::encode(CHtml::value($detail, "finish_date"))); ?></td>
            <td><?php echo CHtml::encode(CHtml::value($detail, 'memo')); ?></td>
            <?php if ($i == 0) : ?>
                <td colspan="2" rowspan="15" style="vertical-align: top;" >
                    <br/><br/>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $workOrderDrawing->is_construction_layout ? 'X' : ' '; ?>) Gambar Konstruksi</span><br/><br/>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $workOrderDrawing->is_front_side_view ? 'X' : ' '; ?>) Front & Side View</span><br/><br/>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $workOrderDrawing->is_section ? 'X' : ' '; ?>) Section</span><br/><br/>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $workOrderDrawing->is_control_layout ? 'X' : ' '; ?>) Gambar Kontrol</span><br/><br/>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $workOrderDrawing->is_component_list ? 'X' : ' '; ?>) Komponen List</span><br/><br/>
                    <br/><br/>
                    NOTE : <?php echo CHtml::encode(CHtml::value($workOrderDrawing, 'memo')); ?>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    <?php for ($j = 15, $i = $i % $j + 1; $j > $i; $j--): ?>
        <tr style="line-height: 25px;">
            <td>&nbsp;</td>
            <td  colspan="3">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    <?php endfor; ?>
</table>

<div class="memosig">
    <div style="font-weight:bold; font-style: italic;" class="divtable">
        <div  class="divtablecell sig1" style="text-align: left; font-weight: normal;">
            <span>LAMPIRAN :</span><br>
            <label>(<?php echo $workOrderDrawing->is_drawing_layout_attached ? 'X' : ' '; ?>)GAMBAR LAYOUT</label><br/>
            <label>(<?php echo $workOrderDrawing->is_technical_specification_attached ? 'X' : ' '; ?>)SPESIFIKASI TEHNIS</label><br/>
            <label>(<?php echo $workOrderDrawing->is_single_line_diagram_attached ? 'X' : ' '; ?>)SINGLE LINE DIAGRAM</label><br/>
            <label>(<?php echo $workOrderDrawing->is_break_down_component_attached ? 'X' : ' '; ?>)BREAK DOWN COMPONENT</label><br/>
        </div>
        <div  class="divtablecell sig2">
            <div>Dibuat</div>
            <div style="height: 50px;"></div>
            <div>(ORDER HANDLER)</div>
        </div>
        <div class="divtablecell sig3">
            <div>Diterima</div>
            <div style="height: 50px;"></div>
            <div>(PERENCANAAN)</div>
        </div>
        <div  class="divtablecell sig4">
			<div>Diketahui</div>
            <div style="height: 50px;"></div>
            <div>(FACTORY MANAGER)</div>
        </div>
    </div>
</div>