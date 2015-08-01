<?php
	class PassHash {           
		private $algo = '$2y'; //Blowfish (requires PHP 5.3.7, older versions need '$2a')
		private $cost = '$10';
                
                public function __construct()
		{
                    
                }
                
		private function UniqueSalt() {
			return substr(sha1(mt_rand()),0,22);
		}
		
		// this will be used to generate a hash
		public function hash($password) {
			return crypt($password,
						$this->algo .
						$this->cost .
						'$' . $this->UniqueSalt());
		}
		
		// this will be used to compare a password against a hash
		public function check_password($hash, $password) {
			$full_salt = substr($hash, 0, 29);
			$new_hash = crypt($password, $full_salt);
			return ($hash == $new_hash);
		}
	}