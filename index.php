<?php
<<<<<<< HEAD
    $stime = microtime(true);
        require_once("includes/autoload.php");
	session_start();
	
        // Get parameters
        $get_mode = filter_input(INPUT_GET, 'm', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        $get_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $get_filter = filter_input(INPUT_GET, 'f', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        
        if (!empty($_POST))
        {
            $get_mode = filter_input(INPUT_POST, 'mode', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        }
        
        if (!isset($get_mode))
        {
            $get_mode = "list";
        }
        
        // Set up page
	$page = new Page($get_mode, $get_id, $get_filter);
        
        // Check for special modes
        if($get_mode == "logout")
        {
            unset($_SESSION["user"]);
            session_destroy();
            $page->AddToSidebar(new SidebarHint(_("You have been logged out!"), true));
        }
        
        // Handle POST data
        if (!empty($_POST))
        {
            switch ($get_mode)
            {
                case "register":
                    $formvalid = true;
                    $mysql = new MySQL();

                    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                    $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                    $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);

                    if (empty($name))
                    {
                        $page->AddToSidebar(new SidebarHint(_("User name may not be empty!"), true));
                        $formvalid = false;
                    } else {
                        if ($mysql->CheckUserName($name))
                        {
                            $page->AddToSidebar(new SidebarHint(_("User name is taken."), true));
                            $formvalid = false;
                        }
                    }
                    if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL))
                    {
                        $page->AddToSidebar(new SidebarHint(_("That does not seem to be a valid e-mail address."), true));
                        $formvalid = false;
                    }
                    if (empty($password))
                    {
                        $page->AddToSidebar(new SidebarHint(_("Please choose a password!"), true));
                        $formvalid = false;
                    }
                    if ($password != $password2)
                    {
                        $page->AddToSidebar(new SidebarHint(_("Passwords do not match!"), true));
                        $formvalid = false;
                    }

                    if ($formvalid)
                    {
                        $result = $mysql->CreateUser($name, $mail, $password);
                        if ($result == "OK")
                        {
                            $page->setContentID(1);
                            $page->AddToSidebar(new SidebarHint(_("User ") . $name . _(" has been created, but still needs to be activated.")));
                        } else {
                            $page->AddToSidebar(new SidebarHint(_("MySQL error. Please try again or contact administrator: <br>\r\n") . $result, true));
                        }
                    }
                    break;
                case "login":
                    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                    $mysql = new MySQL();
                    if ($mysql->CheckUserPass($name, $password))
                    {
                         $_SESSION["user"] = new User($name);
                        $page->AddToSidebar(new SidebarHint(_("Welcome, ") . $_SESSION["user"]->GetName() . "!"));
                    } else {
                        $page->AddToSidebar(new SidebarHint(_("Wrong password."), true));
                    }
                    break;
            }
        }
        
        // Customise page content (TODO: Move customisation to in-app admin menu. This should be completely empty.
	
        // Set the site name to be displayed on all the pages and the section
	$sitename = "Nuntii";
        $sitesection = "Test area";
        // TODO: Get $sitename from config and $sitesection from $page (maybe even use $page->sitesection in includes/html.php instead?)
        
        $ftime = microtime(true);
        $ttime = $ftime - $stime;
        
        $page->AddToSidebar(new SidebarBox(_("Page served in ") . round($ttime, 3) . "s."));
        
        // Load HTML Boilerplate
        require_once("includes/html.php");
=======

// Set up autoload
function __autoload($classname) {
    $filename = "./classes/" . $classname . ".php";
    if (file_exists($filename)) {
        include_once($filename);
        return true;
    }
    return false;
}

// Get parameters
$mode = filter_input(INPUT_GET, "m", FILTER_SANITIZE_STRING) || "list";
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) || -1;

// Check if installation has even been done yet, otherwise set to installation mode
if (!file_exists("includes/config.php")) {
    $mode = "install";
} else {
    
}

// Fill placeholder stuff into page
$page = new Page($mode);
$page->AddToSidebar(new SidebarHint("I'm giving you a night call to tell you how I feel"));
$page->AddToSidebar(new SidebarHint("I want to drive you through the night, down the hills"));
$page->AddToSidebar(new SidebarHint("I'm gonna tell you something you don't want to hear"));
$page->AddToSidebar(new SidebarHint("I'm gonna show you where it's dark, but have no fear!"));
$page->AddToSidebar(new SidebarBox());
$page->AddToSidebar(new SidebarHint("This hint is really long to test how text wider than the element's width gets handled. Bear with me while I FUCK YOUR SHIT UP!"));
$page->AddToSidebar(new SidebarBox());

$sitename = "Nuntii";
?>
<html>
    <head>
        <title><?php echo($sitename); ?></title>

        <link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
        <link href="css/stylesheet.css" rel="stylesheet" type="text/css" />

        <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="js/jquery-nuntii.js" type="text/javascript"></script>
    </head>
</body>
<div id="wrapper">
    <div id="header">
        <?php require_once("includes/header.php"); ?>
    </div>
    <div id="content">
        <?php echo($page->ToHTML()); ?>
    </div>
    <div id="footer">
        <?php require_once("includes/footer.php"); ?>
    </div>
</div>
</body>
</html>
>>>>>>> origin/unstable
