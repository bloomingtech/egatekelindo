<?php

class SqlViewGenerator extends CComponent
{
        public static function count($view)
	{
		$sql = "SELECT COUNT(*) FROM ({$view}) v";

		return $sql;
	}
    
	public static function partListQuantityRemaining()
	{
		$sql = "SELECT p.quantity - COALESCE(packingList.quantity, 0) AS quantity_partListed, p.id AS part_list_detail_id
				FROM " . PartListDetail::model()->tableName() . " p
				LEFT OUTER JOIN
				(
					SELECT part_list_detail_id, SUM(quantity) AS quantity
					FROM " . PackingListDetail::model()->tableName() . "
					GROUP BY part_list_detail_id
				) packingList
				ON p.id = packingList.part_list_detail_id";
		
		return $sql;
	}
	
	public static function purchaseQuantityRemaining()
	{
		$sql = "SELECT p.quantity - COALESCE(receive.quantity, 0) AS quantity_purchased, p.id AS purchase_detail_id
				FROM " . PurchaseDetail::model()->tableName() . " p
				LEFT OUTER JOIN
				(
					SELECT purchase_detail_id, SUM(quantity) AS quantity
					FROM " . ReceiveDetail::model()->tableName() . "
					GROUP BY purchase_detail_id
				) receive
				ON p.id = receive.purchase_detail_id";
		
		return $sql;
	}
	
	public static function saleQuantityRemaining()
	{
		$sql = "SELECT s.quantity - COALESCE(delivery.quantity, 0) AS quantity_sold, s.id AS sale_detail_id
				FROM " . SaleDetail::model()->tableName() . " s
				LEFT OUTER JOIN
				(
					SELECT sale_detail_id, SUM(quantity) AS quantity
					FROM " . DeliveryDetail::model()->tableName() . "
					GROUP BY sale_detail_id
				) delivery
				ON s.id = delivery.sale_detail_id";
		
		return $sql;
	}
	
	public static function localStock()
	{
		$sql = "SELECT COALESCE(SUM(quantity_in) - SUM(quantity_out), 0) 
				FROM " . Inventory::model()->tableName() ." 
				WHERE product_color_size_id = :product_color_size_id AND warehouse_id = :warehouse_id";
		
		return $sql;
	}
        
        public static function balance()
	{
		$sql = "SELECT h.date, h.account_id, d.account_id AS detail_account_id, d.amount AS debit, 0 AS credit, d.memo AS note, d.is_inactive
				FROM " . DepositHeader::model()->tableName() . " h 
				INNER JOIN " . DepositDetail::model()->tableName() . " d ON h.id = d.deposit_header_id
				WHERE h.account_id = :account_id AND h.is_inactive = 0 AND d.is_inactive = 0
				UNION ALL
				SELECT h.date, h.account_id, d.account_id AS detail_account_id, 0 AS debit, d.amount AS credit, d.memo AS note, d.is_inactive
				FROM " . ExpenseHeader::model()->tableName() . " h 
				INNER JOIN " . ExpenseDetail::model()->tableName() . " d ON h.id = d.expense_header_id
				WHERE h.account_id = :account_id AND h.is_inactive = 0 AND d.is_inactive = 0
				UNION ALL
				SELECT h.date,  d.account_id, h.account_id AS detail_account_id, 0 AS debit, d.amount AS credit, d.memo AS note, d.is_inactive
				FROM " . DepositHeader::model()->tableName() . " h 
				INNER JOIN " . DepositDetail::model()->tableName() . " d ON h.id = d.deposit_header_id
				WHERE d.account_id = :account_id AND h.is_inactive = 0 AND d.is_inactive = 0
				UNION ALL
				SELECT h.date,  d.account_id, h.account_id AS detail_account_id, d.amount AS debit, 0 AS credit, d.memo AS note, d.is_inactive
				FROM " . ExpenseHeader::model()->tableName() . " h 
				INNER JOIN " . ExpenseDetail::model()->tableName() . " d ON h.id = d.expense_header_id
				WHERE d.account_id = :account_id AND h.is_inactive = 0 AND d.is_inactive = 0
				UNION ALL
				SELECT h.date,  d.account_id, d.account_id AS detail_account_id, d.debit AS debit, d.credit AS credit, d.memo AS note, d.is_inactive
				FROM " . JournalVoucherHeader::model()->tableName() . " h 
				INNER JOIN " . JournalVoucherDetail::model()->tableName() . " d ON h.id = d.journal_voucher_header_id
				WHERE d.account_id = :account_id AND h.is_inactive = 0 AND d.is_inactive = 0
				";
		
		return $sql;
	}
}