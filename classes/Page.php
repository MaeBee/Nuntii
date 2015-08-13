<?php
	class Page
	{
		private $maincontent;
		private $sidebar;
		private $mode;
		private $id;
                private $filter;
		
		public function __construct()
		{
			// Since we'll need a sidebar anyway, we're creating it now. We're also setting the default mode in case none got set.
			$this->sidebar = new Sidebar();
			$this->mode = "list";
			$this->id = 0;
                        $this->filter = null;
			
			$a = func_get_args();
			$i = func_num_args();
			
			// Check if a constructor for the given amount of parameters exists and execute it
			if (method_exists($this,$f='__construct'.$i)) {
				call_user_func_array(array($this,$f),$a);
			} else {
				// If not, execute all-purpose constructor here
			}
			
			// With the mode set, we can proceed to evaluate and set up the page's main content.
			switch ($this->mode) {
                                case ("list" || "login" || "logout"):
                                        $maincontent = null;
                                        if (!isset($this->filter))
                                        {
                                                $maincontent = new PostList();
                                        } else {
                                                $maincontent = new PostList();
                                        }
					$this->maincontent = $maincontent;
					break;
				case "user":
					$maincontent = new UserPage($this->id);
                                        $this->maincontent = $maincontent;
					break;
                                case "register":
                                        $maincontent = new HTMLPage("./includes/register.php", $this->id);
                                        $this->maincontent = $maincontent;
                                        break;
			}			
		}
		
		private function __construct1($a1)
		{
			// Class got constructed with one parameter. Expected is a string containing the page mode (e.g. "post", "static", or "user").
			$this->mode = $a1;
		}
		
		private function __construct2($a1, $a2)
		{
			// Class got constructed with two parameters. Expected is a string containing the page mode (e.g. "post", "static", or "user") and an int containing the ID.
			$this->mode = $a1;
			$this->id = $a2;
		}
		
		private function __construct3($a1, $a2, $a3)
		{
			// Class got constructed with three parameters. Expected is a string containing the page mode (very likely to be "list"), an int containing the ID, and a string denominating the filter (e.g. "tag", "author", or similar).
			$this->mode = $a1;
			$this->id = $a2;
			$this->filter = $a3;
		}
                
		public function AddToSidebar($element)
		{
			$sidebar = $this->sidebar;
			$sidebar->Add($element);
			$this->sidebar = $sidebar;
		}
		
		public function AddToMaincontent($element)
		{
			$maincontent = $this->maincontent;
			$maincontent->Add($element);
			$this->maincontent = $maincontent;
		}
		
		public function ToHTML()
		{
			$html = "";
			$maincontent = $this->maincontent;
			$sidebar = $this->sidebar;
			
			// Create main content
			$html .= "<div id=\"maincontent\">\r\n";
				$html .= $maincontent->ToHTML() . "\r\n";
				$html .= "<p style=\"text-align: right;\"><a href=\"#wrapper\">" . _("Back to top") . "</a></p>\r\n";
			$html .= "</div>\r\n";
			
			// Create sidebar
			$html .= "<div id=\"sidebar\">\r\n";
				$html .= $sidebar->ToHTML() . "\r\n";
			$html .= "</div>\r\n";
			
			return $html;
		}

                public function setContentID($id)
                {
                    $this->maincontent->setID($id);
                    return true;
                }

}