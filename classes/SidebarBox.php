<?php

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