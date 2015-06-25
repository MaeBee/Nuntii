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
	$hintA = new SidebarHint("Hello");
	$hintB = new SidebarHint();
	$hintB->SetText("World");
	
	$postA = new Post();
	$postB = new Post();
	
	$postList = new PostList();
?>
<html>
	<head>
		<title>Nuntii</title>
		<link href="stylesheet.css" rel="stylesheet" type="text/css" />
	</head>
	</body>
		<div id="wrapper">
			<div id="header">
			</div>
			<div id="content">
				<div id="maincontent">
					<?php echo($postList->ToHTML()); ?>
					<p style="text-align: right;"><a href="#wrapper">Back to top</a></p>
				</div>
				<div id="sidebar">
					<?php echo($hintA->ToHTML());
					echo($hintB->ToHTML()); ?>
				</div>
			</div>
			<div id="footer">
			</div>
		</div>
	</body>
</html>