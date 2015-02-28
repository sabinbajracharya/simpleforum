<?php
	class User extends Connection{
		
		public function __construct(){
			parent::__construct();	
		}//construtor ends
		
		public function verifyUsername($username){
			$this->sql = "select * from users where username = '$username'";
			$this->res = mysqli_query($this->conx,$this->sql);
			$this->numRows = mysqli_num_rows($this->res);
		}//verifyUsername function ends
		
		public function verifyPassword($password){
			$this->sql = "select * from users where password = '$password'";
			$this->res = mysqli_query($this->conx,$this->sql);
			$this->numRows = mysqli_num_rows($this->res);				
		}//verifyPassword function ends
		
		public function accountVerification($username,$password){
			$this->verifyUsername($username);
			if($this->numRows > 0){
					$this->verifyPassword($password);
				if($this->numRows>0){
					session_start();
					$_SESSION['username'] = "$username";
					header("Location:../index.php");
				}else{
					echo "Don't try to fake wrong username or password! Are you trying to hack someone else account?";	
				}
			}else{
					echo "Don't try to fake wrong username or password! Are you trying to hack someone else account?";	
				}
		}//accountVerification function ends
		
		public function getPostByDate($username,$date){
			$this->sql = "select postid from posts where post_username='$username' and date='$date'";
			$this->res = mysqli_query($this->conx,$this->sql);
			$this->numRows = mysqli_num_rows($this->res);
			if($this->numRows>0){
				$row = mysqli_fetch_assoc($this->res);
				$_SESSION['postid'] = $row['postid'];
				return true;		
			}else{
				return false;
			}
		}
		
		public function insertPost($title,$username){
			$date = Date('Y-m-d H:i:s');
			$this->sql = "insert into posts (title,date,post_username) values('$title','$date','$username')";
			$this->res = mysqli_query($this->conx,$this->sql);
			$this->affectedRows = mysqli_affected_rows($this->conx);
			if($this->affectedRows>0){
				if($this->getPostByDate($username,$date)){
					return true;
				}
				return false;
			}else{
				return false;
			}
		}	
		
		public function getPostById($postid){
			$this->sql = "select * from posts where postid='$postid'";
			$this->res = mysqli_query($this->conx,$this->sql);
			$this->numRows = mysqli_num_rows($this->res);
			if($this->numRows>0){
				$row = mysqli_fetch_assoc($this->res);
				return $row;		
			}		
		}
		
		public function addReply($postid,$reply){
			$date = Date('Y-m-d H:i:s');
			$username = $_SESSION['username'];
			$this->sql = "insert into subposts (detail,date,subpost_username,subpost_postid) values('$reply','$date','$username','$postid')";
			$this->res = mysqli_query($this->conx,$this->sql);
			$this->affectedRows = mysqli_affected_rows($this->conx);
			if($this->affectedRows>0){
				return true;
			}else{
				return false;	
			}
		}
		
		public function getPostReply($postid,$start,$limit){
			if($start ==0 && $limit ==0){
				$this->sql = "select count(*) as total from subposts where subpost_postid = '$postid' order by date asc";
				$this->res = mysqli_query($this->conx,$this->sql);
				$this->data = array();
				$row = mysqli_fetch_assoc($this->res);
				array_push($this->data,$row);
				return $this->data;
			}else{
				$this->sql = "select * from subposts where subpost_postid = '$postid' order by date asc limit $start,$limit";
				$this->res = mysqli_query($this->conx,$this->sql);
				$this->data = array();
				while($row = mysqli_fetch_assoc($this->res)){
					array_push($this->data,$row);
				}
				return $this->data;	
			}
		}
		
		public function getPopularPost($start,$limit){
			$this->data = array();
			if($limit>0){
				$this->sql = "select postid,title,count(subpostid) as count from posts inner join subposts on postid = subpost_postid group by postid order by count desc limit $start,$limit";
				$this->res = mysqli_query($this->conx,$this->sql);
				$this->data = array();
				while($row = mysqli_fetch_assoc($this->res)){
					array_push($this->data,$row);	
				}
			}else{
				$this->sql = "select count(*) as total from posts order by date desc";				
				$this->res = mysqli_query($this->conx,$this->sql);
				$row = mysqli_fetch_assoc($this->res);
				array_push($this->data,$row);
			}	
			return $this->data;
		}// getPopularPost function ends
		
		public function getRecentPost($start,$limit){
			$this->data = array();
			if($limit>0){
				$this->sql = "select postid,title,posts.date,count(subpostid) as count FROM posts left join subposts on postid = subpost_postid group by postid order by date desc limit $start,$limit";	
				$this->res = mysqli_query($this->conx,$this->sql);
				while($row = mysqli_fetch_assoc($this->res)){
					array_push($this->data,$row);	
				}	
			}else{
				$this->sql = "select count(*) as total from posts order by date desc";				
				$this->res = mysqli_query($this->conx,$this->sql);
				$row = mysqli_fetch_assoc($this->res);
				array_push($this->data,$row);					
			}		
			return $this->data;
			
		}//getRecentPost function ends
		
		public function search($text,$start,$limit){
			//ALTER TABLE posts ADD FULLTEXT index_name(title); yo garnu parchha table ma to add FULLTEXT Index
			if($start ==0 && $limit ==0){
				$this->sql = "SELECT count(*) as total FROM posts where match(title) against('$text')";
				$this->res = mysqli_query($this->conx,$this->sql);
				$row = mysqli_fetch_assoc($this->res);
				$this->data = array();
				array_push($this->data,$row);
				return $this->data;
			}else{
				$this->sql = "SELECT postid,title,count(subpostid) as count FROM posts left join subposts on postid = subpost_postid where match(title) against('$text' IN BOOLEAN MODE) group by postid limit $start, $limit";
				$this->res = mysqli_query($this->conx,$this->sql);
				$this->data = array();
				while($row = mysqli_fetch_assoc($this->res)){
					array_push($this->data,$row);
				}
				return $this->data;	
			}
			
		}
		
		public function register($name,$username,$password,$email){
			$date = date('Y-m-d H:i:s');
			$this->sql = "insert into users (name,email,username,password,status,joindate) values('$name','$email','$username','$password',0,'$date')";
			$this->res = mysqli_query($this->conx,$this->sql);
			$this->affectedRows = mysqli_affected_rows($this->conx);
			if($this->affectedRows > 0){
				echo "Account Successfully Created!";
			}else{
				echo "Sorry cannot create your account for som unknown reason!";	
			}
		}
			
	}//class ends
?>