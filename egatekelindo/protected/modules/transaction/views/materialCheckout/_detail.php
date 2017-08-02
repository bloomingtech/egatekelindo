<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Nama Barang</th>
        <th style="text-align: center; width: 15%">Brand</th>
        <th style="text-align: center; width: 10%">Qty</th>
    </tr>

    <?php foreach ($materialCheckout->details as $i => $detail): ?>
        <tr style="background-color: azure;">
            <td>
                <?php echo CHtml::activeHiddenField($detail, "[$i]packing_list_detail_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'packingListDetail.partListDetail.component.name')); ?>
            </td>
            <td style="text-align: center">
                <?php echo CHtml::encode(CHtml::value($detail, 'packingListDetail.partListDetail.component.componentBrand.name')); ?>
            </td>
            <td style="text-align: center;">
                <?php echo CHtml::activeHiddenField($detail, "[$i]quantity"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'quantity')); ?>
            </td>
        </tr>		

    <?php endforeach; ?>
</table>
