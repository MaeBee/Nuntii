<?php
	class UserPage extends Post
	{
		private $user;
		
		public function __construct()
		{
			$a = func_get_args();
			$i = func_num_args();
			
			// Check if a constructor for the given amount of parameters exists and execute it
			if (method_exists($this,$f='__construct'.$i)) {
				call_user_func_array(array($this,$f),$a);
			} else {
				// If not, execute all-purpose constructor here
			}
		}
		
		private function __construct1($a1)
		{
			// Class got constructed with one parameter. Expected is an int with the user ID, which we will now use to create a new User object automagickally getting all the information we need to display our User Page.
                        // However, it may not be set, so we'll have to check and come up with a backup plan.
			if (!isset($a1)) {
				$a1 = 0;
			}
                        $this->user = new User($a1);
		}
                
		public function GetID()
		{
			return $this->user->GetID();
		}
		
		public function GetName()
		{
			return $this->user->GetName();
		}
		
		public function ToHTML()
		{
			$html = "";
			return $html;
		}
	}