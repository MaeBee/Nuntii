<div id="headerbanner"></div>
<nav>
    <ul>
        <li><a href="index.php" class="menuitem"><?php echo(_("Home")) ?></a></li>
	<?php
	if (isset($_SESSION["user"]))
	{
		?>
        <li><a href="index.php?m=logout" class="menuitemright"><?php echo(_("Logout")) ?></a></li>
        <li><a href="index.php?m=usercp" class="menuitemright"><?php echo($_SESSION["user"]->GetName()) ?></a></li>
		<?php
		if ($_SESSION["user"]->GetStatus() > 1)
		{
			?>
        <li><a href="index.php?a=1" class="menuitemright"><?php echo(_("Admin panel")) ?></a></li>
			<?php
		}
	}
	else
	{
		?>
        <li><a href="index.php?m=register" class="menuitemright"><?php echo(_("Register")) ?></a></li>
        <li><div class="loginform">
            <form  action="index.php" method="post">
                <input name="name" type="text" id="username" size="3" />
                <input name="password" type="password" id="password" size="3" />
                <input name="mode" value="login" type="hidden"/>
                <input name="Login" type="submit" id="Login" value="<?php echo(_("Login")) ?>" />
            </form>
        </div></li>
		<?php
	}
    ?>
    </ul>
</nav>