<h1>List Purchase Order</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'requirement-grid',
    'dataProvider' => $purchaseHeaderDataProvider,
    'filter' => $purchaseHeader,
    'columns' => array(
        array(
            'header' => 'PO #',
            'filter' =>
            '<div style="display: inline-block">' . CHtml::activeTextField($purchaseHeader, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; /' . PurchaseHeader::CN_CONSTANT . '/ &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeDropDownList($purchaseHeader, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeTextField($purchaseHeader, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => '$data->getCodeNumber(PurchaseHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'date',
            'filter' => false, //CHtml::activeTextField($purchaseHeader, 'date'),
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)',
            'htmlOptions' => array('style' => 'width: 130px'),
        ),
        array(
            'header' => 'SO #',
            'filter' => false, 
            'value' => '($data->saleOrderHeader !== null) ? $data->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT) : "N/A"',
        ),
        array(
            'header' => 'Project Name',
            'name' => 'project_name',
            'value' => 'CHtml::value($data, "project_name")',
        ),
        array(
            'header' => 'Company',
            'value' => 'CHtml::encode(CHtml::value($data->saleOrderHeader,"client_company"))',
        ),
        array(
            'header' => 'Supplier',
            'value' => 'CHtml::encode(CHtml::value($data, "supplier.company"))'
        ),
        array(
            'header' => '',
            'type' => 'raw',
            'value' => 'CHtml::link("Create", array("create", "purchaseId"=>$data->id))',
            'htmlOptions' => array(
                'style' => 'text-align: center;'
            ),
        ),
    ),
));
?>
