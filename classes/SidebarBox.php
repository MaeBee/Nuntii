<?php
<<<<<<< HEAD
	class SidebarBox
	{
            private $text;
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
                    $html .= "<div>\r\n";
                            $html .= "<p>" . $this->GetText() . "</p>\r\n";
                    $html .= "</div>\r\n";
                    return $html;
            }
	}
=======

class SidebarBox extends SidebarElement {

    public function ToHTML() {
        $html = "";
        $html .= "<div>\r\n";
        $html .= "<p>I am a sidebar box. You can fill me with text or make me do stuff.</p>\r\n";
        $html .= "</div>\r\n";
        return $html;
    }

}

?>
>>>>>>> origin/unstable
