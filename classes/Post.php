<?php

class Post {

    private $author;
    private $mySQL;
    private $postID = 0;
    private $postDate = "Tuesday, 11th of November 2014, 20:18 MET";
    private $postBody = "<p>Hello World</p>";

    public function __construct() {
        $this->author = new User(1);
        $this->mySQL = new MySQL();
    }

    public function GetTagsHTML() {
        return "Boogie Woogie, foo, bar";
    }

    public function GetAuthorID() {
        $author = $this->author;
        return $author->GetID();
    }

    public function GetAuthorName() {
        $author = $this->author;
        return $author->GetName();
    }

    public function ToHTML($list = false) {
        $postBody = $this->postBody;
        $readlink = "";
        if ($list) {
            $explosion = explode("<!--more-->", $postBody);
            $postBody = $explosion[0];
            if (count($explosion) > 1) {
                $readlink .= "<p><a href=\"index.php?m=post&id=" . $this->postID . "\">" . _("Read more...") . "</a></p>\r\n";
            } else {
                $readlink .= "<p><a href=\"index.php?m=post&id=" . $this->postID . "\">" . _("View article") . "</a></p>\r\n";
            }
        }
        $html = "";
        // Open div
        $html .= "<div class=\"post\">\r\n";
        // Post Header
        $html .= "<a href=\"index.php?m=post&id=" . $this->postID . "\"><h1>This is a post</h1></a>\r\n";
        $html .= "<p><a href=\"index.php?m=user&id=" . $this->GetAuthorID() . "\">" . $this->GetAuthorName() . "</a> on " . $this->postDate . "</p>\r\n";

        // Post Body
        $html .= $postBody . "\r\n";
        if ($list) {
            $html .= $readlink;
        };

        // Post End
        $html .= "<p>" . $this->GetTagsHTML() . "</p>\r\n";

        // Close div
        $html .= "</div>\r\n";
        return $html;
    }

}

?>