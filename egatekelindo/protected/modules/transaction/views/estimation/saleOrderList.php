<h1>List Sale Order</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'work-order-machining-grid',
    'dataProvider' => $saleOrderHeaderDataProvider,
    'filter' => $saleOrderHeader,
    'columns' => array(
        array(
            'name' => 'cn_ordinal',
            'header' => 'SO #',
            'filter' => '<div style="display: inline-block">' . CHtml::activeTextField($saleOrderHeader, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; /' . SaleOrderHeader::CN_CONSTANT . '/ &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeDropDownList($saleOrderHeader, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeTextField($saleOrderHeader, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => '$data->getCodeNumber(SaleOrderHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 200px'),
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'date',
            'filter' => CHtml::activeTextField($saleOrderHeader, 'date'),
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)',
        ),
        array(
            'header' => 'Project Name',
            'name' => 'project_name',
            'filter' => CHtml::activeTextField($saleOrderHeader, 'project_name'),
            'value' => 'CHtml::value($data, "project_name")',
        ),
		array(
            'header' => 'Client Company',
            'name' => 'client_company',
            'filter' => CHtml::activeTextField($saleOrderHeader, 'client_company'),
            'value' => 'CHtml::value($data, "client_company")',
        ),
        'note',
        array(
            'header' => '',
            'type' => 'raw',
            'value' => 'CHtml::link("Create", array("create", "saleOrderId"=>$data->id))',
            'htmlOptions' => array(
                'style' => 'text-align: center;'
            ),
        ),
    ),
));
?>
