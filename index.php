<?php

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