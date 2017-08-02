
<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('Jurnal #', ''); ?>
                <span id="code_number">
                    <?php echo CHtml::encode($journal->header->getCodeNumber(JournalVoucherHeader::CN_CONSTANT)); ?>
                </span>	
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', ''); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $journal->header,
                    'attribute' => 'date',
                    // additional javascript options for the date picker plugin
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'readonly' => true,
                    ),
                ));
                ?>
                <?php echo CHtml::error($journal->header, 'date'); ?>
            </div>


        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($journal->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($journal->header, 'note'); ?>
            </div>
        </div>
    </div>

    <hr />

    <div class="row buttons">
        <?php echo CHtml::button('Cari Akun', array('name' => 'Search', 'onclick' => '$("#account-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#account-dialog").dialog("open"); return false; }')); ?>
        <?php echo CHtml::hiddenField('AccountId'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::error($journal->header, 'error'); ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('journal' => $journal)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?')); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->

<div>
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'account-dialog',
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Accounts',
            'autoOpen' => false,
            'width' => 'auto',
            'modal' => true,
        ),
    ));
    ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'account-grid',
        'dataProvider' => $accountDataProvider,
        'filter' => $account,
        'selectionChanged' => 'js:function(id) {
			$("#AccountId").val($.fn.yiiGridView.getSelection(id));
			$("#account-dialog").dialog("close");
			$.ajax({
				type: "POST",
				url: "' . CController::createUrl('AjaxHtmlAddAccount', array('id' => $journal->header->id, 'nt' => $journal->header->is_non_tax)) . '",
				data: $("form").serialize(),
				success: function(html) { $("#detail_div").html(html); },
			});
		}',
        'columns' => array(
            'code: Kode',
            'name:nama Akun',
        ),
    ));
    ?>

    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</div>