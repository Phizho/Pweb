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
		<input type="submit" name="btnlogin" value="login">
		<br>
		<p>tidak punya akun??</p>
		<a href="formregister.php">Daftar Disini</a>
	</form>
</body>
</html>