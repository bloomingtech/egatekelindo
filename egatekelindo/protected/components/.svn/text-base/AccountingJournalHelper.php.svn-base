<?php

class AccountingJournalHelper extends CComponent
{
	public static function make($type, $transactionNumber, $date, $accountId, $total, $transactionType, $memo)
	{
//		$this->deleteRow($transactionNumber, $branchId, $transactionType);
		
		$accountingJournal = new JournalAccounting();
		$accountingJournal->transaction_number = $transactionNumber;
		$accountingJournal->account_id = $accountId;
		$accountingJournal->date = $date;
		$accountingJournal->admin_id = 1;
		$accountingJournal->type = $transactionType;
		$accountingJournal->memo = $memo;
		$accountingJournal->$type = $total;

		return $accountingJournal;
	}
	
	public static function deleteRow($transactionNumber, $transactionType) 
	{
		JournalAccounting::model()->deleteAllByAttributes(array(
			'transaction_number' => $transactionNumber, 
//			'account_id' => $accountId,
			'type' => $transactionType
		));
	}
}
