<h1>List Budgeting</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'work-order-machining-grid',
    'dataProvider' => $budgetingHeaderDataProvider,
    'filter' => $budgetingHeader,
    'columns' => array(
        array(
            'name' => 'cn_ordinal',
            'header' => 'Budgeting #',
            'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($budgetingHeader, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; /' . BudgetingHeader::CN_CONSTANT . '/ &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeDropDownList($budgetingHeader, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeTextField($budgetingHeader, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => '$data->getCodeNumber(BudgetingHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'date',
            'filter' => CHtml::activeTextField($budgetingHeader, 'date'),
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
            'value' => '$data->saleOrderHeader->getCodeNumber(SaleOrderHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Project Name',
            'name' => 'projectName',
            'filter' => CHtml::textField('ProjectName', $projectName),
            'value' => 'CHtml::value($data, "saleOrderHeader.project_name")',
        ),
        array(
            'header' => 'Company',
            'value' => 'CHtml::encode(CHtml::value($data->saleOrderHeader,"client_company"))',
        ),
        array(
            'header' => '',
            'type' => 'raw',
            'value' => 'CHtml::link("Create", array("create", "budgetingId"=>$data->id))',
            'htmlOptions' => array(
                'style' => 'text-align: center;'
            ),
        ),
    ),
));
?>
