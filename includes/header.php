<div id="headerbanner"></div>
<nav>
    <a href="index.php" class="menuitem"><span><?php echo(_("Home")) ?></span></a>
<<<<<<< HEAD
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
=======
    <?php
    if (isset($_SESSION['username'])) {
        ?>
        <a href="logout.php" class="menuitemright"><span><?php echo(_("Logout")) ?></span></a>
        <a href="usercp.php" class="menuitemright"><span><?= $_SESSION["username"] ?></span></a>
        <?php
        if ($_SESSION["userrank"] > 0) {
            ?>
            <a href="admin/index.php" class="menuitemright"><span>Admin panel</span></a>
            <?php
        }
    } else {
        ?>
        <a href="register.php" class="menuitemright"><span><?php echo(_("Register")) ?></span></a>
        <a class="menuitemright loginform"><span>
                <form  action="login.php" method="post">
                    <input name="username" type="text" id="username" size="3" />
                    <input name="password" type="password" id="password" size="3" />
                    <input name="Login" type="submit" id="Login" value="<?php echo(_("Login")) ?>" />
                </form>
            </span></a>
        <?php
    }
>>>>>>> origin/unstable
    ?>
</nav>