<h1>List SPK Gambar</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'work-order-machining-grid',
    'dataProvider' => $workOrderDrawingHeaderDataProvider,
    'filter' => $workOrderDrawingHeader,
    'columns' => array(
        array(
            'name' => 'cn_ordinal',
            'header' => 'SPK Gambar #',
            'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($workOrderDrawingHeader, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; /' . WorkOrderDrawingHeader::CN_CONSTANT . '/ &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeDropDownList($workOrderDrawingHeader, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeTextField($workOrderDrawingHeader, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => '$data->getCodeNumber(WorkOrderDrawingHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'date',
            'filter' => CHtml::activeTextField($workOrderDrawingHeader, 'date'),
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)',
            'htmlOptions' => array('style' => 'width: 130px'),
        ),
         array(
            'header' => 'SO #',
            'filter' => '<div style="display: inline-block">' . CHtml::textField('SoOrdinal', $soOrdinal, array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; /' . SaleOrderHeader::CN_CONSTANT . '/ &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::dropDownList('SoMonth', $soMonth, array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::textField('SoYear', $soYear, array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => '$data->budgetingHeader->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Project Name',
            'name' => 'projectName',
            'filter' => CHtml::textField('ProjectName', $projectName),
            'value' => 'CHtml::value($data, "budgetingHeader.saleOrderHeader.project_name")',
        ),
        array(
            'header' => 'Company',
            'value' => 'CHtml::encode(CHtml::value($data->budgetingHeader->saleOrderHeader,"client_company"))',
        ),
        array(
            'header' => '',
            'type' => 'raw',
            'value' => 'CHtml::link("Create", array("create", "workOrderDrawingId"=>$data->id))',
            'htmlOptions' => array(
                'style' => 'text-align: center;'
            ),
        ),
    ),
));
?>
