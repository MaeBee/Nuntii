<div id="headerbanner"></div>
<nav>
    <a href="index.php" class="menuitem"><span><?php echo(_("Home")) ?></span></a>
	<?php
	if (isset($_SESSION["user"]))
	{
		?>
		<a href="index.php?m=logout" class="menuitemright"><span><?php echo(_("Logout")) ?></span></a>
		<a href="index.php?m=usercp" class="menuitemright"><span><?php echo($_SESSION["user"]->GetName()) ?></span></a>
		<?php
		if ($_SESSION["user"]->GetStatus() > 1)
		{
			?>
			<a href="index.php?a=1" class="menuitemright"><span><?php echo(_("Admin panel")) ?></span></a>
			<?php
		}
	}
	else
	{
		?>
		<a href="index.php?m=register" class="menuitemright"><span><?php echo(_("Register")) ?></span></a>
		<a class="menuitemright loginform"><span>
			<form  action="index.php" method="post">
				<input name="name" type="text" id="username" size="3" />
				<input name="password" type="password" id="password" size="3" />
				<input name="mode" value="login" type="hidden"/>
				<input name="Login" type="submit" id="Login" value="<?php echo(_("Login")) ?>" />
			</form>
		</span></a>
		<?php
	}
    ?>
</nav>