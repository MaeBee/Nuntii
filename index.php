<?php
	function __autoload($classname)
	{
		$filename = "./classes/". $classname .".php";
		if (file_exists($filename)) {
			include_once($filename);
			return true;
		}
		return false;
	}
	
	$page = new Page();
	$page->AddToSidebar(new SidebarHint("Hello"));
	$page->AddToSidebar(new SidebarHint("World"));
	$page->AddToSidebar(new SidebarBox());
	$page->AddToSidebar(new SidebarHint("This hint is really long to test how text wider than the element's width gets handled. Bear with me while I FUCK YOUR SHIT UP!"));
	$page->AddToSidebar(new SidebarBox());
?>
<html>
	<head>
		<title>Nuntii</title>
		
		<link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
		<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
		
		<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="js/jquery-nuntii.js" type="text/javascript"></script>
	</head>
	</body>
		<div id="wrapper">
			<div id="header">
			</div>
			<div id="content">
				<?php echo($page->ToHTML()); ?>
			</div>
			<div id="footer">
			</div>
		</div>
	</body>
</html>