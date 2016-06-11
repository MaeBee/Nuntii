<?php
	class Post
	{
		private $postID;
                private $postType;
		private $postAuthor;
                private $postCategory;
                private $postTitle;
		private $postBody;
		private $postDate;
                private $postTags;
                private $postSidebar;
		
		public function __construct()
		{
			$a = func_get_args();
			$i = func_num_args();
                        // Check if a constructor for the given amount of parameters exists and execute it
			if (method_exists($this,$f='__construct'.$i)) {
				call_user_func_array(array($this,$f),$a);
			} else {
				// If not, execute all-purpose constructor here
			}
                        //var_dump($a);
		}
		
                private function __construct1($a1)
                {
                    $this->postID = $a1[0];
                    $this->postType = $a1[1];
                    $this->postAuthor = new User($a1[2]);
                    $this->postCategory = $a1[3];
                    $this->postTitle = $a1[4];
                    $this->postBody = $a1[5];
                    $this->postDate = date("l, jS \of F Y, G:i:s T",$a1[6]);
                    $this->postTags = $a1[7];
                    $this->postSidebar = $a1[8];
                }
                
		public function GetTagsHTML()
		{
			return "Boogie Woogie, foo, bar";
		}
		
		public function GetAuthorID()
		{
			$author = $this->postAuthor;
			return $author->GetID();
		}
		
		public function GetAuthorName()
		{
			$author = $this->postAuthor;
			return $author->GetName();
		}
		
		public function ToHTML($list = false)
		{
			$postBody = $this->postBody;
			$readlink = "";
			if ($list) {
				$explosion = explode("<!--more-->", $postBody);
				$postBody = $explosion[0];
				if(count($explosion) > 1)
				{
					$readlink .= "<p><a href=\"index.php?m=post&id=" . $this->postID . "\">" . _("Read more...") . "</a></p>\r\n";
				}
				else
				{
					$readlink .= "<p><a href=\"index.php?m=post&id=" . $this->postID . "\">" . _("View article") . "</a></p>\r\n";
				}
			}
			$html = "";
			// Open div
			$html .= "<div class=\"post\">\r\n";
				// Post Header
				$html .= "<a href=\"index.php?m=post&id=" . $this->postID . "\"><h1>" . $this->postTitle . "</h1></a>\r\n";
				$html .= "<p><a href=\"index.php?m=user&id=" . $this->GetAuthorID() . "\">" . $this->GetAuthorName() . "</a> on " . $this->postDate . "</p>\r\n";
				
				// Post Body
				$html .= $postBody . "\r\n";
				if ($list) {
					$html .= $readlink;
				}
				
				// Post End
				$html .= "<p>" . $this->GetTagsHTML() . "</p>\r\n";
				
			// Close div
			$html .= "</div>\r\n";
			return $html;
		}
	}