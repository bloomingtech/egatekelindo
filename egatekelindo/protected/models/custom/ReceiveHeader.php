<?php

class ReceiveHeader extends ReceiveHeaderBase
{
	const CN_CONSTANT = 'RCV'; 
	
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}