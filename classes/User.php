<?php
	class User
	{
		private $id;
		
		public function __construct($id)
		{
			if (!isset($id)) {
				$id = 0;
			}
		}
		
		public function GetID()
		{
			return 2;
		}
		
		public function GetName()
		{
			return "gobbo";
		}
		
		public function ToHTML()
		{
			
		}
	}
?>