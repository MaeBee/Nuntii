<?php
    class HTMLPage
    {
        private $includeHTML;
        private $id;
        
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
        
        public function __construct1($a1)
        {
            $this->includeHTML = $a1;
        }
        
        public function __construct2($a1, $a2)
        {
            $this->includeHTML = $a1;
            $this->id = $a2;
        }
        
        public function setInclude($include)
        {
            $this->includeHTML = $include;
            return true;
        }
        
        public function setID($id)
        {
            $this->id = $id;
            return true;
        }
        
        public function ToHTML()
        {
            $return = include($this->includeHTML);
            return $return[$this->id];
        }
    }