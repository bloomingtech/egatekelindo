<h1>List Requirement</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'requirement-grid',
    'dataProvider' => $requirementHeaderDataProvider,
    'filter' => $requirementHeader,
    'columns' => array(
        array(
            'name' => 'cn_ordinal',
            'header' => 'Requirement #',
            'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($requirementHeader, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; /' . $requirementHeader->cnConstant . '/ &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeDropDownList($requirementHeader, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeTextField($requirementHeader, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => '$data->getCodeNumber($data->cnConstant)',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Tanggal SO',
            'filter' => false, //CHtml::activeTextField($requirementHeader, 'date'),
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->saleOrderHeader->date)',
            'htmlOptions' => array('style' => 'width: 130px'),
        ),
         array(
            'header' => 'SO #',
            'filter' => '<div style="display: inline-block">' . CHtml::textField('SoOrdinal', $soOrdinal, array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; /' . SaleOrderHeader::CN_CONSTANT . '/ &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::dropDownList('SoMonth', $soMonth, array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::textField('SoYear', $soYear, array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => '$data->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Project Name',
            'filter' => CHtml::textField('ProjectName', $projectName),
            'value' => 'CHtml::value($data, "saleOrderHeader.project_name")',
        ),
		array(
            'header' => 'Client Name',
            'filter' => CHtml::textField('ClientCompany', $clientCompany),
            'value' => 'CHtml::value($data, "saleOrderHeader.client_company")',
        ),
        array(
            'header' => '',
            'type' => 'raw',
            'value' => 'CHtml::link("Create", array("create", "requirementHeaderId"=>$data->id))',
            'htmlOptions' => array(
                'style' => 'text-align: center;'
            ),
        ),
    ),
));
?>
