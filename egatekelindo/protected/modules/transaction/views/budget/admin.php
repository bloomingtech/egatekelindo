<h2>Budgeting Admin</h2>

<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'budget-grid',
    'dataProvider' => $dataProvider,
    'filter' => $header,
    'columns' => array(
        array(
            'header' => 'Budgeting #',
            'name' => 'cn_ordinal',
            'filter' => CHtml::activeTextField($header, 'cn_ordinal', array('style' => 'width : 60px')) .
            '/' .
            BudgetingHeader::CN_CONSTANT .
            '/' .
            CHtml::activeDropdownList($header, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '', 'style' => 'width : 50px')) .
            '/' .
            CHtml::activeTextField($header, 'cn_year', array('style' => 'width : 60px')),
            'value' => 'CHtml::encode($data->getCodeNumber(BudgetingHeader::CN_CONSTANT))',
			'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'date',
			'filter' => false,
            'value' => 'CHtml::encode(Yii::app()->dateFormatter->format("d MMMM yyyy", CHtml::value($data,"date")))'
        ),
        array(
            'header' => 'SO #',
            'filter' => '<div style="display: inline-block">' . CHtml::textField('SaleOrderCnOrdinal', $saleOrderCnOrdinal, array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; /' . SaleOrderHeader::CN_CONSTANT . '/ &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::dropDownList('SaleOrderCnMonth', $saleOrderCnMonth, array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::textField('SaleOrderCnYear', $saleOrderCnYear, array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => 'CHtml::encode($data->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT))',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Project',
            'filter' => CHtml::textField('ProjectName', $projectName, array('maxLength' => 60, 'size' => 10)),
            'value' => 'CHtml::encode(CHtml::value($data->saleOrderHeader,"project_name"))',
        ),
        array(
            'header' => 'Company',
            'value' => 'CHtml::encode(CHtml::value($data->saleOrderHeader,"client_company"))',
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    )
));
?>
