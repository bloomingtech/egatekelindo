<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center;">Component Name</th>
        <th style="text-align: center;">Type</th>
        <th style="text-align: center;">Brand</th>
        <th style="text-align: center;">Brand Discount</th>
        <th style="text-align: center;">Quantity</th>
        <th style="text-align: center;">Unit Price</th>
        <th style="text-align: center;">Memo</th>
        <th></th>
    </tr>
    <?php if ($requirementDetail->detailAdditionals): ?>
        <?php foreach ($requirementDetail->detailAdditionals as $i => $detail): ?>
            
                <?php 
                $criteria = new CDbCriteria();
                $criteria->with = "budgetingHeader";
                $criteria->condition = "budgetingHeader.sale_order_header_id =:saleOrderId";
                $criteria->params = array(':saleOrderId' => $detail->requirementDetail->requirementHeader->workOrderProductionHeader->workOrderDrawingHeader->budgetingHeader->sale_order_header_id);
                $budgetingBrandDiscounts = BudgetingBrandDiscount::model()->findAll($criteria); 
                
                ?>
                <?php if ($detail->is_inactive == 0): ?>
                <tr>
                    <td><!--name-->
                        <?php echo CHtml::activeHiddenField($detail, "[$i]component_id"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]component_cu_id"); ?>
                        <?php echo CHtml::activeHiddenField($detail, "[$i]requirement_detail_id"); ?>
                        <?php echo CHtml::encode(CHtml::value($detail, 'component.name')); ?>
                        <?php echo CHtml::encode(CHtml::value($detail, 'componentCu.name')); ?>
                    </td>

                    <td style="text-align: center;">
                        <?php echo CHtml::encode(CHtml::value($detail->component, 'type')); ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo CHtml::encode(CHtml::value($detail->component, 'componentBrand.name')); ?>
                    </td>
                    <td style="text-align: center; "> 
                        <?php echo CHtml::activeDropDownList($detail, "[$i]budgeting_brand_discount_id", CHtml::listData($budgetingBrandDiscounts, 'id', 'name'), array('empty' => 'Select')); ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 5, 'maxlength' => 10,));
                        ?>
                        <?php echo CHtml::error($detail, 'quantity'); ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        echo CHtml::activeTextField($detail, "[$i]unit_price", array('size' => 5, 'maxlength' => 10,));
                        ?>
                        <?php echo CHtml::error($detail, 'unit_price'); ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo CHtml::activeTextField($detail, "[$i]memo", array('size' => 30)); ?>
                    </td>

                    <td style="width: 5%">
                        <?php if ($detail->isNewRecord): ?>
                            <?php
                            echo CHtml::button('Delete', array(
                                'onclick' => CHtml::ajax(array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('ajaxHtmlRemoveDetailAdditional', array('id' => $requirementDetail->header->id, 'index' => $i)),
                                    'update' => '#detail_component_additional',
                                )),
                            ));
                            ?>
                        <?php else: ?>
                            <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

</table>