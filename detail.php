<?php 
	session_start();
	if(isset($_GET['selecteditem'])){
		$iditem = $_GET['selecteditem'];
		$_SESSION['iditem'] = $iditem;
		$mysqli = new mysqli("localhost","123448","phi006072","123448");
		$result = mysqli_query($mysqli,"SELECT i.*,u.name as namaUser FROM items i inner join users u on i.iduser_owner = u.iduser where i.iditem = $iditem");

		while ($row = mysqli_fetch_assoc($result))
		{
			if (isset($row)){
			$iditem = $row['iditem'];
			$ext = $row['image_extension'];
			$imgItem = "imageItems/$iditem.$ext ";
			echo "<img src='$imgItem'>";

			echo "<b><br>". $row['name'] ."</b> <br>";
			echo $row['status']."<br>";
			echo "<p>".$row['price_initial']."&nbsp&nbsp";
			echo $row['date_posting']."&nbsp&nbsp";
			echo $row['namaUser']."</p>";
			echo "<br><br><br>";		
			echo "Bidders :
			<table border='1'>";
			$status = $row['status'];
			$res2 = mysqli_query($mysqli,"SELECT b.*,u.name as namaUser,b.iduser as userbid FROM biddings b inner join users u on b.iduser = u.iduser where b.iditem = $iditem");
			if($status == "OPEN"){
				while($row2 = mysqli_fetch_assoc($res2)){
					echo "<tr>";

					echo "<td>".$row2['namaUser']."</td>";
					echo "<td>".$row2['price_offer']."</td>";
					echo "<td>".$row2['is_winner']."</td>";
					echo "<td><a href='ServerUAS.php?userwin=".$row2['userbid']."'>Set Winner</td></tr>"; 

				}
			}
			else{
				while($row2 = mysqli_fetch_assoc($res2)){
					echo "<tr>";

					echo "<td>".$row2['namaUser']."</td>";
					echo "<td>".$row2['price_initial']."</td>";
					echo "<td>".$row2['date_posting']."</td>";
					if($row2['iswinner'] == 1){
						echo "<td>Winner</td>";
					}
					echo "</tr>";
				}
			}
			echo "</table>";
		}
		else{
			$_SESSION['error'] = "data item tidak ditemukan";
			header("location: home.php");
		}
		
		$mysqli->close();
	}
}

 ?>