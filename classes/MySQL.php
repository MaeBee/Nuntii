<?php
<<<<<<< HEAD
	class MySQL
	{
		public function __construct()
		{
                    
		}
                
                public function GetPostsByType($type) {
                    $tableprefix = "nuntii_";
                    return $this->RunQuery("SELECT * FROM " . $tableprefix . "posts WHERE type=? ORDER BY id DESC", "s", [$type]);
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
                    $user = $res->fetch_assoc();
                    $hashing = new PassHash();
                    return $hashing->check_password($user["passhash"], $password);
                }
                
                public function GetUserByName($name)
                {
                    $tableprefix = "nuntii_";
                    $res = $this->RunQuery("SELECT * FROM " . $tableprefix . "users WHERE name=?", "s", [$name]);
                    return $res;
                }
                
                public function GetUserByID($id)
                {
                    $tableprefix = "nuntii_";
                    $res = $this->RunQuery("SELECT * FROM " . $tableprefix . "users WHERE id=?", "i", [$id]);
                    return $res;
                }


                public function RunQuery($query, $types, $params)
                {
                    $array = array_merge([$types], $params);
                    // TODO: Get DB information from config
                    $host = "127.0.0.1";
                    $user = "root";
                    $password = "";
                    $database = "nuntii2";
                    // Establish connection
                    $mysqli = new mysqli($host, $user, $password, $database);
                    // Prepare query
                    $stmt = $mysqli->prepare($query);
                    // Bind parameters
                    $command = "\$stmt->bind_param(";
                    $command .= "\$array[0]";
                    for ($i = 1; $i < count($array); $i++)
                    {
                        $command .= ", \$array[" . $i . "]";
                    }
                    $command .= ");";
                    eval($command);
                    /*if(!$stmt->bind_param($array))
                    {
                        return null;
                    }*/
                    // Otherwise, execute the statement
                    $stmt->execute();
                    // Take the result, destruct the statement, and pass on the result
                    $res = $stmt->get_result();
                    $stmt->close();
                    return $res;
                }
                
                public function CreateUser($name, $mail, $password)
                {
                    $passHash = new PassHash();
                    $hashedPW = $passHash->hash($password);
                    $tableprefix = "nuntii_";
                    // TODO: Get DB information from config
                    $dbhost = "127.0.0.1";
                    $dbuser = "root";
                    $dbpassword = "";
                    $dbdatabase = "nuntii2";
                    
                    //$this->RunQuery("INSERT INTO " . $tableprefix . "users VALUES(NULL, 0, ?, ?, ?, NULL, NULL, 0, NULL)", "sss", array($name, $mail, $hashedPW));
                    // Establish connection
                    if (!$mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbdatabase))
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
=======
class MySQL {

    public function __construct() {
        
    }
    
    
    
}
?>
>>>>>>> origin/unstable
