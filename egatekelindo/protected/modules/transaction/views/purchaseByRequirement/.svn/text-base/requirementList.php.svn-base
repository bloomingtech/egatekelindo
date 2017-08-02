<h1>List Requirement</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'requirement-grid',
    'dataProvider' => $requirementHeaderDataProvider,
    'filter' => $requirementHeader,
    'columns' => array(
        array(
            'header' => 'Requirement #',
            'filter' =>
				'<div style="display: inline-block">' . CHtml::activeTextField($requirementHeader, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
				'<div style="display: inline-block"> &nbsp; /' . RequirementHeader::CN_CONSTANT . '/ &nbsp; </div>' .
				'<div style="display: inline-block">' . CHtml::activeDropDownList($requirementHeader, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
				'<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
				'<div style="display: inline-block">' . CHtml::activeTextField($requirementHeader, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => '$data->getCodeNumber(RequirementHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'date',
            'filter' => false, //CHtml::activeTextField($requirementHeader, 'date'),
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
            'value' => '($data->saleOrderHeader !== null) ? $data->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT) : "N/A"',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Project Name',
            'name' => 'projectName',
            'filter' => CHtml::textField('ProjectName', $projectName),
            'value' => '($data->saleOrderHeader !== null) ? CHtml::value($data, "saleOrderHeader.project_name") : "N/A"',
        ),
        array(
            'header' => 'Company',
            'value' => 'CHtml::encode(CHtml::value($data->saleOrderHeader,"client_company"))',
        ),
        array(
            'header' => '',
            'type' => 'raw',
            'value' => 'CHtml::link("Create", array("create", "requirementId"=>$data->id))',
            'htmlOptions' => array(
                'style' => 'text-align: center;'
            ),
        ),
    ),
));
?>
