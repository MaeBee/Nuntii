<?php
require_once "includes/hashing.php";
$step = "0";

if (file_get_contents("includes/config.php") != "") {
    require_once "includes/config.php";
    require_once "includes/mysql.php";
    $step = "1";
    $val = mysql_query('select 1 from `" . $tableprefix . "_users`');
    if ($val != FALSE) {
        $step = "3";
    } else {
        $step = "3";
    }
}

if ($_POST) {
    if ($step == "0") {
        $content = '<?php
	// Site
	$sitename = "' . $_POST['sitename'] . '";
	
	// MySQL
	$dbhost = \'' . $_POST['dbhost'] . '\';
	$dbname = \'' . $_POST['dbname'] . '\';
	$dbuser = \'' . $_POST['dbuser'] . '\';
	$dbpasswd = \'' . $_POST['dbpasswd'] . '\';
	$tableprefix = \'' . $_POST['tableprefix'] . '\';
	
	// JavaScripts
	$jquery = "js/jquery-1.10.2.min.js";
	$jqueryui = "js/jquery-ui-1.10.3.js";
	$jshadowbox = "js/shadowbox/shadowbox.js";
	$jbeforeafter = "js/beforeafter/jquery.beforeafter-1.4.min.js";
	
	// CSS
	$cshadowbox = "js/shadowbox/shadowbox.css";
?>';
        file_put_contents("includes/config.php", $content);
        $step = "1";
    }
    if ($step == "2") {
        if ($_POST['userpw'] == $_POST['userpw2']) {
            $passwordhash = PassHash::hash($_POST['userpw']);
            $sql = "INSERT INTO `" . $tableprefix . "_users` (`id`, `name`, `mail`, `password`, `rank`, `authorid`) VALUES
				(1, '" . $_POST['username'] . "', '" . $_POST['useremail'] . "', '" . $passwordhash . "', 3, 1);";
            $query = mysql_query($sql) or die();
            echo "User " . $_POST['username'] . " created\n";

            $step = "3";
        } else {
            echo "Passwords don't match!";
        }
    }
}
if ($step == "1") {
    require_once "includes/config.php";
    require_once "includes/mysql.php";
    $echo = "MySQL connection OK\r\n";

    $sql = "CREATE TABLE IF NOT EXISTS `" . $tableprefix . "_posts` (
		  `id` int(16) NOT NULL auto_increment,
		  `authorid` int(16) NOT NULL,
		  `categoryid` int(16) NOT NULL,
		  `date` int(64) NOT NULL,
		  `title` varchar(512) NOT NULL,
		  `body` varchar(10240) NOT NULL,
		  `tags` varchar(512) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
    $query = mysql_query($sql) or die();

    $sql = "CREATE TABLE IF NOT EXISTS `" . $tableprefix . "_categories` (
		  `id` int(16) NOT NULL auto_increment,
		  `name` varchar(128) NOT NULL,
		  `description` varchar(512) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
    $query = mysql_query($sql) or die();

    $sql = "CREATE TABLE IF NOT EXISTS `" . $tableprefix . "_menu` (
		  `id` int(4) NOT NULL auto_increment,
		  `text` varchar(128) character set utf8 NOT NULL,
		  `link` varchar(128) character set utf8 NOT NULL,
		  `priority` int(4) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
    $query = mysql_query($sql) or die();

    $sql = "CREATE TABLE IF NOT EXISTS `" . $tableprefix . "_tags` (
		  `id` int(16) NOT NULL auto_increment,
		  `name` varchar(128) NOT NULL,
		  `description` varchar(512) NOT NULL,
		  PRIMARY KEY  (`id`),
		  UNIQUE KEY `name` (`name`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
    $query = mysql_query($sql) or die();

    $sql = "CREATE TABLE IF NOT EXISTS `" . $tableprefix . "_users` (
		  `id` int(16) NOT NULL auto_increment,
		  `name` varchar(16) NOT NULL,
		  `email` varchar(128) NOT NULL,
		  `password` varchar(128) NOT NULL,
		  `rank` int(16) NOT NULL,
		  `body` int(10240) default NULL,
		  `registerdate` int(64) NOT NULL,
		  `sidebar` varchar(1024) NOT NULL,
		  `uservars` varchar(2048) NOT NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
    $query = mysql_query($sql) or die();

    $sql = "CREATE TABLE IF NOT EXISTS `" . $tableprefix . "_variables` (
		  `name` varchar(128) NOT NULL,
		  `value` varchar(512) NOT NULL,
		  PRIMARY KEY  (`name`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
    $query = mysql_query($sql) or die();

    $step = "2";
}
?>

<html>
    <head>
        <title>Nuntii installation</title>
    </head>
    <body>
        <?php if ($step == "0") {
            ?>
            <h1>Step 1: Config file</h1>
            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post"><table>
                    <tr>
                        <td align="right">Site Name</td>
                        <td><input name="sitename" type="text" size="50" maxlength="128" value="Nuntii Site"></td>
                    </tr>
                    <tr>
                        <td align="right">Database Server</td>
                        <td><input name="dbhost" type="text" size="50" maxlength="128" value="localhost"></td>
                    </tr>
                    <tr>
                        <td align="right">Database Name</td>
                        <td><input name="dbname" type="text" size="50" maxlength="128" value="db1"></td>
                    </tr>
                    <tr>
                        <td align="right">Database User</td>
                        <td><input name="dbuser" type="text" size="50" maxlength="128" value="admin"></td>
                    </tr>
                    <tr>
                        <td align="right">Database Password</td>
                        <td><input name="dbpasswd" type="text" size="50" maxlength="128" value="password"></td>
                    </tr>
                    <tr>
                        <td align="right">Database Table Prefix</td>
                        <td><input name="tableprefix" type="text" size="50" maxlength="128" value="nuntii"></td>
                    </tr>
                    <tr>
                    <input type="hidden" name="step" value="<?= $step ?>"/>
                    <td align="right"><input type="submit" value="Send"></td>
                    <td><input type="reset" value="Cancel"></td>
                    </tr></table>
            </form>
            <?php
        }
        if ($step == "2") {
            ?>
            <h1>Step 2: Admin user</h1>
            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post"><table>
                    <tr>
                        <td align="right">Admin User Name</td>
                        <td><input name="username" type="text" size="50" maxlength="128" value="admin"></td>
                    </tr>
                    <tr>
                        <td align="right">Admin User </td>
                        <td><input name="useremail" type="text" size="50" maxlength="128" value="admin@yoursite.com"></td>
                    </tr>
                    <tr>
                        <td align="right">Password</td>
                        <td><input name="userpw" type="password" size="50" maxlength="128"></td>
                    </tr>
                    <tr>
                        <td align="right">Password (again)</td>
                        <td><input name="userpw2" type="password" size="50" maxlength="128"></td>
                    </tr>
                    <tr>
                    <input type="hidden" name="step" value="<?= $step ?>"/>
                    <td align="right"><input type="submit" value="Send"></td>
                    <td><input type="reset" value="Cancel"></td>
                    </tr></table>
            </form>
            <?php
        }
        if ($step == "3") {
            ?>
            <h1>Installation successful!</h1>
            <p>Welcome to Nuntii! you can now log in on the <a href="index.php">home page</a> with your user name and password.</p>
            <p>It is recommended to delete the install.php from the main directory to prevent possible security breacches.</p>
        <?php } ?>
    </body>
</html>