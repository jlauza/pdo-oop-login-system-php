<?php
require_once 'config.php';

if(!$user->is_loggedin()) {
	$user->redirect('login.php');
	}

$user_id = $_SESSION['userSession'];
$stmt = $dbconn->prepare("SELECT * FROM user WHERE id=user_id");
$stmt->execute(array("user_id"=>$user_id));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

include_once 'header.php';
$title = $row['username']. "'s Dashboard";
?>

<h1>Homepage</h1>
<p>Welcome <?php print($row['fname' && 'lname']); ?></p>
<a href="logout.php" name="logout" class="btn btn-info"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>

<?php include_once 'footer.php';