<div class ="form">
    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($estimation->header); ?>

    <table> 
        <tr>
            <td>
                <?php if (!$estimation->header->isNewRecord): ?>
                    <?php echo CHtml::label('Estimasi #', false); ?>
                    <?php echo CHtml::encode($estimation->header->getCodeNumber(NULL)); ?> 
                <?php endif; ?>
            </td>
            <td>
                <?php echo CHtml::label('Project Name', ''); ?>
                <?php echo CHtml::encode(CHtml::value($estimation->header, 'project_name')); ?>
            </td>
        </tr>
        <tr>
<!--            <td>&nbsp;
            <?php //echo CHtml::label('Initial', ''); ?>
            <?php //echo CHtml::activeTextField($estimation->header, 'cn_initial'); ?>
            <?php //echo CHtml::error($estimation->header, 'cn_initial'); ?>
            </td>-->
            <td>
                <?php echo CHtml::label('Tanggal', ''); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $estimation->header,
                    'attribute' => 'date',
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'readonly' => true,
                    ),
                ));
                ?>
                <?php echo CHtml::error($estimation->header, 'date'); ?>
            </td>
            <td>
                <?php echo CHtml::label('Company', ''); ?>
                <?php echo CHtml::encode(CHtml::value($estimation->header, 'client_company')); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo CHtml::label('Catatan', false); ?>
                <?php echo CHtml::activeTextArea($estimation->header, 'note'); ?>
                <?php echo CHtml::error($estimation->header, 'note'); ?>
            </td>

            <td>
                <?php echo CHtml::label('Name', ''); ?>
                <?php echo CHtml::encode(CHtml::value($estimation->header, 'client_name')); ?>
            </td>
        </tr>

<!--        <tr>
    
    <td>&nbsp;
        <?php //echo CHtml::label('Component Brand', false); ?> 
        <?php //echo CHtml::activeDropDownList($estimation->header, "component_brand_id", CHtml::listData(ComponentBrand::model()->findAll(), 'id', 'name'), array('empty' => 'Select Brand')); ?>
        <?php //echo CHtml::error($estimation->header, 'component_brand_id'); ?> 
    </td>
</tr>-->
<!--        <tr>
    <td>
        <?php //echo CHtml::label('Mark Up Wiring Low', ''); ?>
        <?php //echo CHtml::activeTextField($estimation->header, 'mark_up_wiring_low'); ?>
        <?php //echo CHtml::error($estimation->header, 'mark_up_wiring_low'); ?>
    </td>
    <td>
        <?php //echo CHtml::label('Mark Up All', ''); ?>
        <?php //echo CHtml::activeTextField($estimation->header, 'mark_up_all'); ?>
        <?php //echo CHtml::error($estimation->header, 'mark_up_all'); ?>
    </td>
</tr>-->
<!--        <tr>
    <td>
        <?php //echo CHtml::label('Mark Up Wiring High', ''); ?>
        <?php //echo CHtml::activeTextField($estimation->header, 'mark_up_wiring_high'); ?>
        <?php //echo CHtml::error($estimation->header, 'mark_up_wiring_high'); ?>
    </td>
    <td>
        <?php //echo CHtml::label('Mark Up Accesories', ''); ?>
        <?php //echo CHtml::activeTextField($estimation->header, 'mark_up_accesories'); ?>
        <?php //echo CHtml::error($estimation->header, 'mark_up_accesories'); ?>
    </td>
</tr>-->
<!--        <tr>
    <td>
        <?php //echo CHtml::label('Mark Up Wiring Border', ''); ?>
        <?php //echo CHtml::activeTextField($estimation->header, 'mark_up_wiring_border'); ?>
        <?php //echo CHtml::error($estimation->header, 'mark_up_wiring_border'); ?>
    </td>
    <td>
        &nbsp;
    </td>
</tr>-->
    </table>

    <div id="detail_div_currency">
        <?php //$this->renderPartial('_detail_currency', array('estimation' => $estimation)); ?>
    </div>

    <div id="detail_div">
        <?php //$this->renderPartial('_detail', array('estimation' => $estimation)); ?>
    </div>

    <div class="row">
        <?php
//        echo CHtml::button('Tambah Panel', array(
//            'name' => 'panel-detail',
//            'onclick' => CHtml::ajax(array(
//                'type' => 'POST',
//                'url' => CController::createUrl('ajaxAddPanel', array('id' => $estimation->header->id)),
//                'success' => 'function(html){
//                    $("#detail_man").html(html);
//                }'
//            ))
//        ));
        ?>
    </div>

    <div id="detail_man">
        <?php //$this->renderPartial('_detail_panel', array('estimation' => $estimation)); ?>
    </div>

    <?php //echo CHtml::submitButton('Next', array('name' => 'Next', 'confirm' => 'Are you sure you want to next?')); ?>

    <?php echo CHtml::submitButton('Save', array('name' => 'Save', 'confirm' => 'Are you sure you want to save?')); ?>

    <?php echo CHtml::endForm(); ?>
</div>
