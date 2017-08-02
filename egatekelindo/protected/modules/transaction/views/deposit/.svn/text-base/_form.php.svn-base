<div class="form">

<?php echo CHtml::beginForm(); ?>
        
	<div class="container">
		<div class="span-12">
			<div class="row">
				<?php echo CHtml::label('Pemasukan #', ''); ?>
				<?php $depositHeaderConstant;
					if($deposit->header->is_bank)
						$depositHeaderConstant=DepositHeader::CN_CONSTANT_BANK;
					else
						$depositHeaderConstant=DepositHeader::CN_CONSTANT_CASH;
				?>
				<span id="code_number">
									
				<?php	echo CHtml::encode($deposit->header->getCodeNumber($depositHeaderConstant)); ?>
					
				</span>	
			</div>

			<div class="row">
				<?php echo CHtml::label('Tanggal', ''); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'model'=>$deposit->header,
						'attribute'=>'date',
						// additional javascript options for the date picker plugin
						'options'=>array(
								'dateFormat'=>'yy-mm-dd',
						),
						'htmlOptions'=>array(
								'readonly'=>true,
						),
				)); ?>
				<?php echo CHtml::error($deposit->header, 'date'); ?>
			</div>

			<div class="row">
				<?php echo CHtml::activeLabelEx($deposit->header, 'account_id'); ?>
				<?php echo CHtml::activeDropDownList($deposit->header, 'account_id', CHtml::listData(Account::model()->findAll(array('order' => 't.name', 'condition' => 'account_category_id IN (1, 2)')), 'id', 'name'), array('empty' => '-- Pilih Akun --')); ?>
				<?php echo CHtml::error($deposit->header, 'account_id'); ?>
			</div>
		</div>

		<div class="span-12 last">
			<div class="row">
				<?php echo CHtml::label('Catatan', ''); ?>
				<?php echo CHtml::activeTextArea($deposit->header, 'note', array('rows'=>5, 'cols'=>30)); ?>
				<?php echo CHtml::error($deposit->header, 'note'); ?>
			</div>
		</div>
	</div>

	<hr />
        
	<div class="row buttons">
		<?php echo CHtml::button('Cari Akun', array('name'=>'Search', 'onclick'=>'$("#account-dialog").dialog("open"); return false;', 'onkeypress'=>'if (event.keyCode == 13) { $("#account-dialog").dialog("open"); return false; }')); ?>
		<?php echo CHtml::hiddenField('AccountId'); ?>
	</div>
     
	<div class="row">
		<?php echo CHtml::error($deposit->header, 'error'); ?>
   </div>
	
	<div id="detail_div">
		<?php $this->renderPartial('_detail', array('deposit'=>$deposit)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit', array('name'=>'Submit', 'confirm'=>'Are you sure you want to save?')); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->

<div>
	<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		'id'=>'account-dialog',
		// additional javascript options for the dialog plugin
		'options'=>array(
			'title'=>'Accounts',
			'autoOpen'=>false,
			'width'=>'auto',
			'modal'=>true,
		),
	)); ?>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'account-grid',
		'dataProvider' => $accountDataProvider,
		'filter' => $account,
		'selectionChanged'=>'js:function(id) {
			$("#AccountId").val($.fn.yiiGridView.getSelection(id));
			$("#account-dialog").dialog("close");
			$.ajax({
				type: "POST",
				url: "'.CController::createUrl('AjaxHtmlAddAccount', array('id'=>$deposit->header->id, 'nt' => $deposit->header->is_non_tax)).'",
				data: $("form").serialize(),
				success: function(html) { $("#detail_div").html(html); },
			});
		}',
	   'columns'=>array(
			'code: Kode',
			'name:nama Akun',
		 
		),
	)); ?>

	<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</div>