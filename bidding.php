<?php 
	session_start();
	if(isset($_GET['selecteditem'])){
		$iditem = $_GET['selecteditem'];
		$mysqli = new mysqli("localhost","root","","projectpweb");
		$result = mysqli_query($mysqli,"SELECT i.*,u.name as namaUser FROM items i inner join users u on i.iduser_owner = u.iduser where i.iditem = $iditem");

		if ($row = mysqli_fetch_assoc($result))
		{
			$iditem = $row['iditem'];
			$ext = $row['image_extension'];
			$imgItem = "gambar/.'$iditem'.'$ext' ";
			echo "<img src='$imgItem'>";

			echo "<b>". $row['name'] ."</b> <br>";
			echo $row['status']."<br>";
			echo "<p>".$row['price_initial']."&nbsp&nbsp";
			echo $row['date_posting']."&nbsp&nbsp";
			echo $row['namaUser']."</p>";
			echo"<form method='post' action='ServerUAS.php'>
				<label for='bidval'> Bid Value: </label>
				<input type='text' id='bidval' name='bidval'>
				<br>
				<input type='submit' name='btnbid' value='bid'>
				<input type='submit' name='btnback' value='back'>
				</form>";
		}
		$mysqli->close();
	}
	else{
		header("location: index.php");
	}

 ?>
