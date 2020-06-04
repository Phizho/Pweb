<?php 
	session_start();
	if(isset($_GET['selecteditem'])) {
		$iditem = $_GET['selecteditem'];
		$mysqli = new mysqli("localhost","123448","phi006072","123448");
		$result = mysqli_query($mysqli,"SELECT i.*,u.name as namaUser FROM items i inner join users u on i.iduser_owner = u.iduser where i.iditem = $iditem");

		if ($row = mysqli_fetch_assoc($result))
		{
			if (isset($row))
			{
				if ($row['iduser_owner'] != $_SESSION['userid_login']){
					$_SESSION['iditem'] = $row['iditem'];
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
						<label for='bidval'> bid value: </label>
						<input type='text' id='bidval' name='bidval'>
						<br>
						<input type='submit' name='btnbid' value='bid'>
						<input type='submit' name='btnback' value='back'>
						</form>";
				}
				else {
					header("location: detail.php?selecteditem=$iditem");
					$mysqli->close();
				}
			}
			else {
				$_SESSION['error'] = "data item tidak ditemukan";
				header("location: index.php");
			}
			$mysqli->close();
		
		}
	}
 ?>