<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="ServerUAS.php">
		<label for="name"> Item Name: </label>
		<input type="text" id="pwd" name="name">
		<label for="price"> Initial Price: </label>
		<input type="text" id="pwd" name="price">
		<label for="imgExt"> Image Extension: </label>
		<input type="password" id="pwd" name="imgExt">
		<br><br>
		<input type="submit" name="btnadditem" value="Add Item">
		<input type="submit" name="btnback" value="back">
	</form>
</body>
</html>

<?php
	
?>