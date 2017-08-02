<h1>List Purchase Request</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'purchase-request-grid',
    'dataProvider' => $purchaseRequestHeaderDataProvider,
    'filter' => $purchaseRequestHeader,
    'columns' => array(
        array(
            'header' => 'Request #',
            'filter' =>
            '<div style="display: inline-block">' . CHtml::activeTextField($purchaseRequestHeader, 'cn_ordinal', array('maxLength' => 4, 'size' => 2)) . '</div>' .
            '<div style="display: inline-block"> &nbsp; /' . PurchaseRequestHeader::CN_CONSTANT . '/ &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeDropDownList($purchaseRequestHeader, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '')) . '</div>' .
            '<div style="display: inline-block"> &nbsp; / &nbsp; </div>' .
            '<div style="display: inline-block">' . CHtml::activeTextField($purchaseRequestHeader, 'cn_year', array('maxLength' => 2, 'size' => 2)) . '</div>',
            'value' => '$data->getCodeNumber(PurchaseRequestHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 300px'),
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'date',
            'filter' => CHtml::activeTextField($purchaseRequestHeader, 'date'),
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)',
            'htmlOptions' => array('style' => 'width: 130px'),
        ),
        array(
            'header' => 'SO #',
            'filter' => false,
            'value' => '(empty($data->workOrderProductionHeader)) ? "N/A" : CHtml::encode($data->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT))',
            'htmlOptions' => array('style' => 'width: 200px'),
        ),
        array(
            'header' => 'Project Name',
            'name' => 'projectName',
            'filter' => false,
            'value' => '(empty($data->workOrderProductionHeader)) ? "N/A" : CHtml::encode(CHtml::value($data, "workOrderProductionHeader.workOrderDrawingHeader.budgetingHeader.saleOrderHeader.project_name")',
        ),
        array(
            'header' => 'Company',
            'value' => '(empty($data->workOrderProductionHeader)) ? "N/A" : CHtml::encode(CHtml::value($data, "workOrderProductionHeader.workOrderDrawingHeader.budgetingHeader.saleOrderHeader.client_company"))',
        ),
        'department.name: Departemen',
        'job.name: Job',
        array(
            'header' => '',
            'type' => 'raw',
            'value' => 'CHtml::link("Create", array("create", "purchaseRequestId"=>$data->id))',
            'htmlOptions' => array(
                'style' => 'text-align: center;'
            ),
        ),
    ),
));
?>
