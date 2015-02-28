<?php
	class Connection{
		private $host;
		private $user;
		private $pswd;
		private $db;
		public $conx;
		public $res;
		public $sql;
		public $numRows;
		public $affectedRows;
		public $data = array();
		
		public function __construct($db = 'word2wise',$h = 'localhost', $u = 'root', $p = ''){
			$this->host = $h;
			$this->user = $u;
			$this->pswd = $p;
			$this->db = $db;
			$this->conx = mysqli_connect($this->host,$this->user,$this->pswd,$this->db);
		}//construct ends
	
		public function __destruct(){
			mysqli_close($this->conx);	
		}//destruct ends
		
	}//class ends
?>