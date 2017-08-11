<?php
require_once 'config.php' ;

if($user->is_loggedin() != "") {
	$user->redirect('home.php');;
	}

if(isset($_POST['register'])) {
	$username = trim($_POST['username']);
	$fname = trim($_POST['fname']);
	$lname = trim($_POST['lname']);
	$pass = trim($_POST['password']);
	$confirm_pass = trim($_POST['confirm_password']);
	$email = trim($_POST['email']);
	
		if($username == "") {
			$err_msg[] = "Username cannot be empty.";
			}
		else if($fname == "") {
			$err_msg[] = "Please provide your firstname.";
			}
		else if($lname == "") {
			$err_msg[] = "Please provide your lastname.";
			}
		else if($pass == "") {
			$err_msg[] = "Password cannot be empty.";
			}
		else if(strlen($pass) < 6) {
			$err_msg[] = "Password must be at least 6 letters.";
			}
		else if($pass != $confirm_pass){
			$err_msg[] = "Password doesn't match.";
			}
		else if($email == "") {
			$err_msg[] = "Please provide your email address.";
			}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$err_msg[] = "Please enter valid email address.";
			}
			else {
				
				try{
					$stmt = $dbconn->prepare("SELECT username, email FROM user WHERE username=username OR email=email");
					$stmt->execute(array('username'=>$username, 'email'=>$email));
					$row=$stmt->fetch(PDO::FETCH_ASSOC);
					
						if($row['username' == $username]){
							$err_msg[] = "Sorry! Username is already taken.";
							}
						else if($row['email'] == $email) {
							$err_msg[] = "Sorry! Email is already taken.";
							}
							else {
								if($user->register($username, $fname, $lname, $pass, $email)){
									$user->redirect('register.php?joined');
									}
								}
					
					}
				catch(PDOException $e){
					echo $e->getMessage();
					}
				
				}//else
	
	}//isset register

$title = "Register";
include_once 'header.php';
?>
	<div style="width:100%;max-width:500px;">
    <form id="register" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="register">
    <h1 class="page-header">Register Account</h1>
    <?php
    if(isset($err_msg)){
			foreach($err_msg as $err_msg){
				?>
                <div class='alert alert-danger'>
                <i class='fa fa-exclamation-circle' aria-hidden='true'></i>
				<?php echo $err_msg; ?> 
                </div>
                <?php
				}
		}
	else if(isset($_GET['joined'])){
                ?>
				<div class='alert alert-info'>
                <i class="fa fa-info-circle" aria-hidden="true"></i>" 
				Successfully registered!
                "</div>"
                <?php		
		}
	?>
      <div class="form-group">      
        <label for="username" class="col-sm-3 control-label">Username</label>
        <div class="col-sm-9">
          <input type="text" name="username" class="form-control" id="username" placeholder="Username" required/>
        </div>
      </div>
      <div class="form-group">
        <label for="fname" class="col-sm-3 control-label">Firstname</label>
        <div class="col-sm-9">
          <input type="text" name="fname" class="form-control" id="fname" placeholder="Firstname" required/>
        </div>
      </div>
      <div class="form-group">
        <label for="lname" class="col-sm-3 control-label">Lastname</label>
        <div class="col-sm-9">
          <input type="text" name="lname" class="form-control" id="lname" placeholder="Lastname" required/>
        </div>
      </div>
      <div class="form-group">
        <label for="password" class="col-sm-3 control-label">Password</label>
        <div class="col-sm-9">
          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required/>
        </div>
      </div>
      <div class="form-group">
        <label for="confirm_password" class="col-sm-3 control-label">Confirm Password</label>
        <div class="col-sm-9">
          <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password" required/>
        </div>
      </div>
      <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-9">
          <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" required/>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
        
          <a href="login.php">Back to Login page</a>
        
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
        
          <button name="register" type="submit" class="btn btn-default">Register</button>
        
        </div>
      </div>
    </form>    
    </div>
        <script>
		$(function(){
			$("#register").validate();
			});
        </script>
<?php
include_once 'footer.php';    