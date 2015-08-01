<?php
    // HTML Boilerplate
?>

<html>
	<head>
		<title><?php
                    echo $sitename;
                    if (isset($sitesection)) { echo (" - " . $sitesection); }
                ?></title>
		
		<link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
		<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
		
		<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="js/jquery-nuntii.js" type="text/javascript"></script>
	</head>
	</body>
		<div id="wrapper">
			<div id="header">
				<?php require_once("./includes/header.php"); ?>
			</div>
			<div id="content">
				<?php echo ($page->ToHTML()); ?>
			</div>
			<div id="footer">
				<?php require_once("./includes/footer.php"); ?>
			</div>
		</div>
	</body>
</html>