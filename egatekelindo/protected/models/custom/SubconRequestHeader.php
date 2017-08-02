<?php

class SubconRequestHeader extends SubconRequestHeaderBase
{
	const CN_CONSTANT = 'SUB'; 
	
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}