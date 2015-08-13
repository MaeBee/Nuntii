<?php
	class SidebarHint
	{
		private $text = "";
		private $id = "";
                private $alert = false;
		
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
			// Class got constructed with one parameter. Expected is a string containing the text for the hint
			$this->SetText($a1);
		}
		
		private function __construct2($a1, $a2)
		{
			// Class got constructed with two parameters. Expected is a string containing the textfor the hint and a bool indicating an alert box instead of a hint box
			$this->SetText($a1);
			$this->SetAlert($a2);
		}
		
		public function SetText($newText)
		{
			$this->text = $newText;
			return true;
		}
		
		public function GetText()
		{
			return $this->text;
		}
		
		public function SetID($newID)
		{
			$this->id = $newID;
			return true;
		}
		
		public function GetID()
		{
			return $this->id;
		}
                
		public function SetAlert($alert)
		{
			$this->alert = $alert;
			return true;
		}
                
                public function GetAlert()
                {
                    return $this->alert;
                }


                public function ToHTML()
		{
			$html = "";
			$html .= "<div class=\"ui-widget nuntii-hint\">\r\n";
                                if ($this->GetAlert())
                                {
                                    $html .= "<div class=\"ui-state-error ui-corner-all\">\r\n<p>\r\n";
                                } else {
                                    $html .= "<div class=\"ui-state-highlight ui-corner-all\">\r\n<p>\r\n";
                                }
					$html .= "<span class=\"nuntiiclose ui-icon ui-icon-close\"></span>\r\n";
					$html .= $this->GetText() . "\r\n";
				$html .= "</p>\r\n</div>\r\n<br/>\r\n";
			$html .= "</div>\r\n";
			return $html;
		}
	}