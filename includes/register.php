<?php
$return0 = "<h1>" . _("Register") . "</h1>\r\n";
$return0 .= "<form action=\"./register.php\" method=\"post\">\r\n";
$return0 .= "    <div>\r\n";
$return0 .= "        " . _("Name") . "<br>\r\n";
$return0 .= "        <input name=\"name\" type=\"text\" size=\"50\" maxlength=\"32\">\r\n";
$return0 .= "    </div>\r\n";
$return0 .= "    <div>\r\n";
$return0 .= "        " . _("E-Mail") . "<br>\r\n";
$return0 .= "        <input name=\"mail\" type=\"text\" size=\"50\" maxlength=\"128\">\r\n";
$return0 .= "    </div>\r\n";
$return0 .= "    <div>\r\n";
$return0 .= "        " . _("Password") . ":<br>\r\n";
$return0 .= "        <input name=\"password\" type=\"password\" size=\"50\" maxlength=\"128\">\r\n";
$return0 .= "    </div>\r\n";
$return0 .= "    <div>\r\n";
$return0 .= "        " . _("Confirm Password") . ":<br>\r\n";
$return0 .= "        <input name=\"password2\" type=\"password\" size=\"50\" maxlength=\"128\">\r\n";
$return0 .= "    </div>\r\n";
$return0 .= "    <div>\r\n";
$return0 .= "        <input type=\"submit\" value=\"" . _("Register") . "\">\r\n";
$return0 .= "    </div>\r\n";
$return0 .= "   <input name=\"mode\" value=\"register\" type=\"hidden\">";
$return0 .= "</form>\r\n";

$return1 = "<h1>" . _("Register") . "</h1>\r\n";
$return1 .= "<div>\r\n";
$return1 .= "       " . _("Thank you for registering! Please check your inbox on further instructions on how to activate and use your account.") . "\r\n";
$return1 .= "</div>\r\n";

$return = array($return0, $return1);

return $return;