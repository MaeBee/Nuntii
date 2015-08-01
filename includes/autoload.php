<?php
        // Function to autoload classes by class name
	function __autoload($classname)
	{
		$filename = "./classes/". $classname .".php";
		if (file_exists($filename)) {
			include_once($filename);
			return true;
		}
		return false;
	}