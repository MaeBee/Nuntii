<?php
	class UserPage extends Post
	{
		private $user;
		private $mySQL;
		
		public function __construct($id)
		{
			if (!isset($id)) {
				$id = 0;
			}
			$this->user = new User($id);
			$this->mySQL = new MySQL();
		}
		
		public function GetID()
		{
			return $user->GetID();
		}
		
		public function GetName()
		{
			return $user->GetName();
		}
		
		public function ToHTML($list = false)
		{
			$html = "";
			return $html;
		}
	}
?>