<?php
	class MySQL
	{
		public function __construct()
		{
		}
                
                public function GetPostsByType($type) {
                    $res = array();
                    $tableprefix = "nuntii_";
                    // TODO: Get DB information from config
                    include("data.php");
                    // Establish connection
                    $mysqli = new mysqli($host, $user, $password, $database);
                    if ($mysqli->connect_errno) {
                        echo "Failed to connect to MySQL.";
                    }
                    // Prepare query
                    if (!($stmt = $mysqli->prepare("SELECT * FROM " . $tableprefix . "posts WHERE type=? ORDER BY id DESC")))
                    {
                        echo "Error Preparing statement.";
                    }
                    // Bind parameters
                    if (!($stmt->bind_param("s", $type)))
                    {
                        echo "Error binding paramets.";
                    }
                    // Execute the statement
                    if (!$stmt->execute()) {
                        echo "Execute failed.";
                    }
                    // Take the result, destruct the statement, and pass on the result
                    $stmt->bind_result($postid, $posttype, $postauthor, $postcategory, $posttitle, $posttext, $posttime, $posttags, $postsidebar);
                    while ($stmt->fetch()) {
                        $res[] = array($postid, $posttype, $postauthor, $postcategory, $posttitle, $posttext, $posttime, $posttags, $postsidebar);
                    }
                    $stmt->close();
                    return $res;
                }
                
                public function CheckUserName($name) {
                    $tableprefix = "nuntii_";
                    $res = $this->RunQuery("SELECT * FROM " . $tableprefix . "users WHERE name=?", "s", [$name]);
                    if ($res->fetch_assoc() != NULL)
                    {
                        return true;
                    } else {
                        return false;
                    }
                }
                
                public function CheckUserPass($name, $password) {
                    $res = $this->GetUserByName($name);
                    $hashing = new PassHash();
                    return $hashing->check_password($res[0][3], $password);
                }
                
                public function GetUserByName($name)
                {
                    $tableprefix = "nuntii_";
                    // TODO: Get DB information from config
                    include("data.php");
                    // Establish connection
                    $mysqli = new mysqli($host, $user, $password, $database);
                    if ($mysqli->connect_errno) {
                        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                    }
                    // Prepare query
                    if (!($stmt = $mysqli->prepare("SELECT * FROM " . $tableprefix . "users WHERE name=?")))
                    {
                        echo "Error Preparing statement.";
                    }
                    // Bind parameters
                    if (!($stmt->bind_param("s", $name)))
                    {
                        echo "Error binding paramets.";
                    }
                    // Execute the statement
                    if (!$stmt->execute()) {
                        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error . "<br/>";
                    }
                    // Take the result, destruct the statement, and pass on the result
                    $stmt->bind_result($userid, $username, $usermail, $userpasshash, $userstatus, $userauthorid);
                    if ($stmt->fetch()) {
                        $res[] = array($userid, $username, $usermail, $userpasshash, $userstatus, $userauthorid);
                    }
                    $stmt->close();
                    return $res;
                }
                
                public function GetUserByID($id)
                {
                    $tableprefix = "nuntii_";
                    // TODO: Get DB information from config
                    include("data.php");
                    // Establish connection
                    $mysqli = new mysqli($host, $user, $password, $database);
                    if ($mysqli->connect_errno) {
                        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                    }
                    // Prepare query
                    if (!($stmt = $mysqli->prepare("SELECT * FROM " . $tableprefix . "users WHERE id=?")))
                    {
                        echo "Error Preparing statement.";
                    }
                    // Bind parameters
                    if (!($stmt->bind_param("i", $id)))
                    {
                        echo "Error binding paramets.";
                    }
                    // Execute the statement
                    if (!$stmt->execute()) {
                        echo "Execute failed.";
                    }
                    // Take the result, destruct the statement, and pass on the result
                    $stmt->bind_result($userid, $username, $usermail, $userpasshash, $userstatus, $userauthorid);
                    if ($stmt->fetch()) {
                        $res[] = array($userid, $username, $usermail, $userpasshash, $userstatus, $userauthorid);
                    }
                    $stmt->close();
                    return $res;
                }
                
                public function CreateUser($name, $mail, $password)
                {
                    $passHash = new PassHash();
                    $hashedPW = $passHash->hash($password);
                    $tableprefix = "nuntii_";
                    // TODO: Get DB information from config
                    $host = "127.0.0.1";
                    $user = "root";
                    $dbpassword = "";
                    $database = "nuntii2";
                    
                    //$this->RunQuery("INSERT INTO " . $tableprefix . "users VALUES(NULL, 0, ?, ?, ?, NULL, NULL, 0, NULL)", "sss", array($name, $mail, $hashedPW));
                    // Establish connection
                    if (!$mysqli = new mysqli($host, $user, $dbpassword, $database))
                    {
                        return $mysqli->error;
                    }
                    // Escape parameters (because of @s and similar) and run query
                    //$name = $mysqli->real_escape_string($name);
                    //$mail = $mysqli->real_escape_string($mail);
                    //$name = $mysqli->real_escape_string($name);
                    if (!$result = $mysqli->query("INSERT INTO " . $tableprefix . "users VALUES(NULL, 0, '" . $name . "', '" . $mail . "', '" . $hashedPW . "', NULL, NULL, 0, NULL, CURRENT_TIMESTAMP)"))
                    {
                        return $mysqli->error;
                    }
                    // Report success.
                    return "OK";
                }
	}