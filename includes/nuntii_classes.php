<?php
	class Post
	{
		
		
		public function ToHTML()
		{
			$html = "";
			// Open div
			$html .= "<div class=\"post\">";
				// Header
				$html .= "<h1>This is a post</h1>";
				$html 
				
			// Close div
			$html .= "</div>";
			return $html;
		}
	}
	
	class Article extends Post
	{
	}
	
	class  extends Post
	{
	}
	
	class SidebarElement
	{
	}
	
	class Hint extends SidebarElement
	{
	}
	
	class Box extends SidebarElement
	{
	}
?>