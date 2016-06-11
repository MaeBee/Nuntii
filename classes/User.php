<?php
	class User
	{
		private $id;
                private $name;
                private $mail;
                private $passhash;
                private $status;
                private $authorid;
		
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
		}
                
                public function __construct1($id)
                {
                    $mysql = new MySQL();
                    $res = [];
                    if (is_int($id))
                    {
                        $res = $mysql->GetUserByID($id);
                    } else
                    if (is_string($id))
                    {
                        $res = $mysql->GetUserByName($id);
                    }
                    $this->id = $res[0];
                    $this->name = $res[1];
                    $this->mail = $res[2];
                    $this->passhash = $res[3];
                    $this->status = $res[4];
                    $this->authorid = $res[5];
                }
		
		public function GetID()
		{
			return $this->data["id"];
		}
		
		public function GetName()
		{
			return $this->data["name"];
		}
                
		public function GetStatus()
		{
			return $this->data["status"];
		}
                
                public function SetData($var, $value)
                {
                    $this->data[$var] = $value;
                    return true;
                }
	}
