<?php
	class SidebarHint extends SidebarElement
	{
		private $text = "";
		
		public function __construct()
		{
			$a = func_get_args();
			$i = func_num_args();
			// Check if a constructor for the given amount of parameters exists and execute it
			if (method_exists($this,$f='__construct'.$i)) {
				call_user_func_array(array($this,$f),$a);
			} else {
				// If not, execute all-purpose constructor
			}
		}
		
		private function __construct1($a1)
		{
			// Class got constructed with one parameter. Expected is a string containing the text for the hint
			$this->text = $a1;
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
		
		public function ToHTML()
		{
			$html = "";
			$html = $html . "<div class=\"sidebarhint\">";
			$html = $html . $this->text;
			$html = $html . "</div>\r\n";
			return $html;
		}
	}
?>