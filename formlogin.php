<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	if (isset($_SESSION['error']))
	{
		echo $_SESSION['error'];
		
		session_destroy();
	}
	 ?>
	<form method="post" action="ServerUAS.php">
		<label for="userid"> User ID: </label>
		<input type="text" id="pwd" name="userid">
		<label for="pwd"> Password: </label>
		<input type="password" id="pwd" name="pwd">
		<br><br>
		<input type="submit" name="btnlogin" value="btnlogin">
		<a href="formregister.php">Daftar Disini</a>
	</form>
	<?php 
	if (isset($_POST['btnlogin']))
	{
		$_SESSION['userid'] = $_POST['userid'];
		$_SESSION['password'] = $_POST['pwd'];
	}
	 ?>
</body>
</html>