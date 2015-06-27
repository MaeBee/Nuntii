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
<<<<<<< HEAD
	$hintA = new SidebarHint("Hello");
	$hintA->SetID("hinta");
	$hintB = new SidebarHint();
	$hintB->SetText("World");
	$hintB->SetID("hintb");
	$hintC = new SidebarHint("This hint is really long to test how text wider than the element's width gets handled. Bear with me while I FUCK YOUR SHIT UP!");
	$hintC->SetID("hintc");
	
	$postA = new Post();
	$postB = new Post();
	
	$postList = new PostList();
	$postList->Add($postA);
	$postList->Add($postB);
	$postList->Add(new Post());
=======
	
	$page = new Page();
	$page->AddToSidebar(new SidebarHint("I'm giving you a night call to tell you how I feel"));
	$page->AddToSidebar(new SidebarHint("I want to drive you through the night, down the hills"));
	$page->AddToSidebar(new SidebarHint("I'm gonna tell you something you don't want to hear"));
	$page->AddToSidebar(new SidebarHint("I'm gonna show you where it's dark, but have no fear!"));
	$page->AddToSidebar(new SidebarBox());
	$page->AddToSidebar(new SidebarHint("This hint is really long to test how text wider than the element's width gets handled. Bear with me while I FUCK YOUR SHIT UP!"));
	$page->AddToSidebar(new SidebarBox());
>>>>>>> origin/unstable
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
<<<<<<< HEAD
				<div id="maincontent">
					<?php echo($postList->ToHTML()); ?>
					<p style="text-align: right;"><a href="#wrapper">Back to top</a></p>
				</div>
				<div id="sidebar">
					<?php echo($hintA->ToHTML());
					echo($hintB->ToHTML());
					echo($hintC->ToHTML()); ?>
				</div>
=======
				<?php echo($page->ToHTML()); ?>
>>>>>>> origin/unstable
			</div>
			<div id="footer">
			</div>
		</div>
	</body>
</html>