<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center;">Komponen</th>
        <th style="text-align: center;">Type</th>
        <th style="text-align: center;">Brand</th>
        <th style="text-align: center;">Qty Esti</th>
		<th style="text-align: center;">Qty Req</th>
		<th style="text-align: center;">Price</th>
		<th style="text-align: center;">Faktor Pengali</th>
<!--        <th></th>-->
    </tr>
    <?php if ($requirementAssurancePanelComponent->detailComponents): ?>
        <?php foreach ($requirementAssurancePanelComponent->detailComponents as $i => $detail): ?>
            <?php if ($detail->is_inactive == 0): ?>
                <tr>
                    <td><!--name-->
                        <?php echo CHtml::activeHiddenField($detail, "[$i]requirement_detail_component_id"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]estimation_component_id"); ?>
                        <?php echo CHtml::encode(CHtml::value($detail, 'requirementDetailComponent.component_name')); ?>
                    </td>

                    <td style="text-align: center;">
                        <?php echo CHtml::encode(CHtml::value($detail, 'requirementDetailComponent.budgetingDetail.type')); ?>
                    </td>
					
                    <td style="text-align: center;">
                        <?php echo CHtml::encode(CHtml::value($detail, 'requirementDetailComponent.budgetingDetail.brand_name')); ?>
                    </td>

					<td style="text-align: center;">
						<?php echo CHtml::encode(CHtml::value($detail, 'requirementDetailComponent.budgetingDetail.estimationComponent.quantity')); ?>
					</td>
					
                    <td style="text-align: center;">
                        <?php echo CHtml::activeHiddenField($detail, "[$i]quantity", array('size' => 5, 'maxlength' => 10,)); ?>
						<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?>
                        <?php echo CHtml::error($detail, 'quantity'); ?>
                    </td>
					
					<td style="text-align: center;">
                        <?php echo CHtml::activeTextField($detail, "[$i]unit_price", array('size' => 15, 'maxlength' => 20,)); ?>
                        <?php echo CHtml::error($detail, 'unit_price'); ?>
                    </td>
					
					<td style="text-align: center;">
						<?php echo CHtml::activeDropDownList($detail, "[$i]requirement_assurance_brand_discount_id", CHtml::listData(RequirementAssuranceBrandDiscount::model()->findAllByAttributes(array('requirement_assurance_header_id' => $requirementAssurancePanelComponent->header->requirement_assurance_header_id), array('order' => 'id')), 'id', 'componentBrandDiscount.componentBrand.name'), array('empty' => '-- PILIH --')); ?>
                        <?php echo CHtml::error($detail, 'requirement_assurance_brand_discount_id'); ?>
					</td>
					
<!--                    <td style="width: 5%">
                        <?php /*if ($detail->isNewRecord): ?>
                            <?php
                            echo CHtml::button('Delete', array(
                                'onclick' => CHtml::ajax(array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('ajaxHtmlRemoveDetail', array('id' => $requirementAssurancePanelComponent->header->id, 'index' => $i)),
                                    'update' => '#detail_component',
                                )),
                            ));
                            ?>
                        <?php else: ?>
                            <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                        <?php endif;*/ ?>
                    </td>-->
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

</table>