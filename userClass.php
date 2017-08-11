<?php
class userClass {
	
	private $dbx;
	
	function _construct($dbconn) {
		$this->dbx = $dbconn;
		}
	
		public function login ($username, $email, $pass) {
				try{
					$stmt = $this->dbx->prepare("SELECT * FROM user WHERE username=username OR email=email LIMIT 1");
					$stmt->execute(array('username'=>$username, 'email'=>$email));
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					
						if($stmt->rowCount() > 0) {
								if(password_verify($pass, $row['password'])){
									$_SESSION['userSession'] = $row['id'];
									return true;
									}
								else{
									return false;
									}
							}
					
					}
				catch(PDOException $e){
					echo $e->getMessage();
					}
			}//login
		
		public function register ($username, $fname, $lname, $pass, $email) {
				try{
					$new_pass = password_hash($pass,PASSWORD_DEFAULT);
					$stmt = $this->dbx->prepare("INSERT INTO user(password,fname,lname,email) VALUES
												('$pass','$fname','$lname','$email')");
					$stmt->bindparam("username",$username);
					$stmt->bindparam("email",$email);
					$stmt->bindparam("password",$new_pass);
					return $stmt;
					}
				catch(PDOException $e) {
					echo $e->getMessage();
					}
			}//register
			
		public function is_loggedin() {
				if(isset($_SESSION['userSession'])){
					return true;
					}
			}//is_loggedin
			
		public function logout() {
				session_destroy();
				unset($_SESSION['userSession']);
				return true;
			}//logout
		
		public function redirect($url) {
				header("Location: $url");
			}//redirect
		 
	}//end