<?php

class Customer extends CustomerBase
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}