<h2>Estimation Admin</h2>

<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'estimation-grid',
    'dataProvider' => $dataProvider,
    'filter' => $header,
    'columns' => array(
        array(
            'header' => 'Estimation #',
            'name' => 'cn_ordinal',
            'filter' => CHtml::activeTextField($header, 'cn_ordinal', array('style' => 'width : 60px')) .
            '/' .
            EstimationHeader::CN_CONSTANT .
            '/' .
            CHtml::activeDropdownList($header, 'cn_month', array(1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'), array('empty' => '', 'style' => 'width : 50px')) .
            '/' .
            CHtml::activeTextField($header, 'cn_year', array('style' => 'width : 60px')),
//                '<br />'.
//                '<div style = "display : inline-block">'. CHtml::activeTextField($header, 'cn_ordinal', array('maxLength'=>4, 'size'=>2)) .'</div>'.
//                '<div style = "display : inline-block">&nbsp; /'.PurchaseHeader::CN_CONSTANT. '/&nbsp;</div>'.
//                '<div style = "display : inline-block">' . CHtml::activeDropdownList($header,'cn_month', array(1 =>'I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'), array('empty'=>'')). '</div>' .
//                '<div style = "display : inline-block"> &nbsp; / &nbsp; </div>' .
//                '<div style = "display : inline-block">'. CHtml::activeTextField($header,'cn_year',array('maxLength'=>2, 'size'=>2)) . '<div>',
            'value' => 'CHtml::encode($data->getCodeNumber(EstimationHeader::CN_CONSTANT))',
        ),
        array(
            'header' => 'Tanggal',
            'name' => 'date',
            'filter' => CHtml::activeTextField($header, 'date'),
            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
        ),
        array(
            'header' => 'SO #',
            'value' => '$data->saleOrderHeader->getNumber(SaleOrderHeader::CN_CONSTANT)',
            'htmlOptions' => array('style' => 'width: 200px'),
        ),
        array(
            'header' => 'Project',
            'name' => 'project_name',
            'filter' => CHtml::activeTextField($header, 'project_name'),
            'value' => 'CHtml::encode(CHtml::value($data,"project_name"))',
        ),
        array(
            'header' => 'Company',
            'name' => 'client_company',
            'filter' => CHtml::activeTextField($header, 'client_company'),
            'value' => 'CHtml::encode(CHtml::value($data,"client_company"))',
        ),
        array(
            'header' => 'Name',
            'name' => 'client_name',
            'filter' => CHtml::activeTextField($header, 'client_name'),
            'value' => 'CHtml::encode(CHtml::value($data,"client_name"))',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}'
        ),
    )
));
?>
