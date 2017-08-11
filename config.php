<?php
	session_start();
	$dbusername = 'root';
	$dbpassword = '';
	
	try {
		  $dbconn = new PDO('mysql:host=localhost;dbname=test', $dbusername, $dbpassword);
		  $dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		  //echo "<div class='alert alert-success'>Successfully connected!</div>";
		}
	catch(PDOException $e){
		echo "<div class='alert alert-danger'>Connection failed:" . $e->getMessage() . "</div>";
		}
		
	include_once 'userClass.php';
	$user = new userClass($dbconn);