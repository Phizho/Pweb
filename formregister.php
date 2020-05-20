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
		echo "14";
	}
	 ?>
	<form method="post" action="ServerUAS.php">
		<label for="userid"> User ID: </label>
		<input type="text" id="pwd" name="userid">
		<label for="userid"> Username: </label>
		<input type="text" id="pwd" name="username">
		<label for="pwd"> Password: </label>
		<input type="password" id="pwd" name="password">
		<label for="pwd"> Retype Password: </label>
		<input type="password" id="pwd" name="passwordulang">
		<br><br>
		<input type="submit" name="btnadd" value="btnadd">
	</form>
</body>
</html>