<?php
<<<<<<< HEAD
	class PostList
	{
		private $posts;
		
		public function __construct()
		{
                    $mysql = new MySQL();
                    $res = $mysql->GetPostsByType("article");
                    
                    while ($row = $res->fetch_assoc())
                    {
                        $this->Add(new Post($row));
                    }
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
				$html .= $post->ToHTML(true);
				$i = $i + 1;
				if ($i < $count) {
					$html .= "<hr>\r\n";
				}
			}
			return $html;
		}
	}
=======
class PostList {

    private $posts;

    public function __construct() {
        
    }

    public function Add($post) {
        $this->posts[] = $post;
    }

    public function ToHTML() {
        $html = "";
        $i = 0;
        $count = count($this->posts);
        foreach ($this->posts as $post) {
            $html .= $post->ToHTML(true);
            $i = $i + 1;
            if ($i < $count) {
                $html .= "<hr>\r\n";
            }
        }
        return $html;
    }

}
?>
>>>>>>> origin/unstable
