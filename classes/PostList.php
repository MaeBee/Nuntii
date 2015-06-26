<?php
	class PostList
	{
		private $posts;
		
		public function __construct()
		{
		}
		
		public function Add($post)
		{
			$this->posts[] = $post;
		}
		
		public function ToHTML()
		{
			$html = "";
			$i = 0;
			$count = count($this->posts);
			foreach ($this->posts as $post) {
				$html .= $post->ToHTML();
				$i = $i + 1;
				if ($i < $count) {
					$html .= "<hr>\r\n";
				}
			}
			return $html;
		}
	}
?>