<?php
require_once 'config.php';

if($user->is_loggedin() != ""){
	$user->redirect('home.php');
	}

if(isset($_POST['login'])) {
	$username = $_POST['username_email'];
	$email = $_POST['username_email'];
	$pass = $_POST['password'];
	
		if($user->login($username,$email,$pass)) {
			$user->redirect('home.php');
			} else {
				$err_msg = "Invalid login details! Please try again.";
				}
	
	}

$title = "Login";
include_once 'header.php';

?>
<div style="width:100%;max-width:500px;">
<form id="login" name="login" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<h1 class="page-header">Login</h1>
	<?php
		if(isset($err_msg)){
			echo "<div class='alert alert-danger'><i class='fa fa-exclamation-circle' aria-hidden='true'></i>" . $err_msg . "</div>";
			}    
    ?>
  <div class="form-group">
    <label for="username_email" class="col-sm-4 control-label">Username/Email</label>
    <div class="col-sm-8">
      <input type="text" name="username_email" class="form-control" id="username_email" placeholder="Username or Email" required/>
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-4 control-label">Password</label>
    <div class="col-sm-8">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password" required/>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
	
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="checkbox">
                <label>
                	<input type="checkbox"> Remember me
                </label>
            </div>
    	</div><!-- col -->
        <div class="col-xs-12 col-sm-6">
            <div class="checkbox">
                <label>
                    <a href="register.php">Create Account</a>
                </label>
            </div>
        </div><!-- col -->
    </div><!-- row -->
    
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button type="submit" class="btn btn-default" name="login">Sign in</button>
    </div>
  </div>
</form> 
</div>

        <script>
		$(function(){
			$("#login").validate();
			});
        </script>
           
<?php include_once 'footer.php';