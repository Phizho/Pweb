<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bidding Site</title>
<style type="text/css">
	#mainbar {
		position: absolute;
	    left: 0px;
	    top: 0px;
	    right: 0px
	    min-height: 100px;
	   	width: 100%; 
	    background-color: yellow;
	    text-align: center;
	}
	.mainbarmenu {
		text-decoration-color: white;
		width: 200px;
		height: 100px;
		float: right;
		text-align: center;
		line-height: 100px;
		font-size: 20px;
	}
	#mainbarhome {
		text-decoration-color: white;
		width: 200px;
		height: 100px;
		float: left;
		text-align: center;
		line-height: 100px;
		font-size: 20px;
	}
	a {
		color: black;
	}
</style>
</head>
<body>
	<div id="mainbar">
		<?php
			if(isset($_SESSION['userid_login'])){
				echo "<div class='mainbarmenu'><a href='ServerUAS.php?log=logout'>Logout</a></div>";
				echo "<div class='mainbarmenu'><a href='add.php'>Add item</a></div>";
			}
			else{	
				echo "<div class='mainbarmenu'><a href='formlogin.php'>Login</a></div>";
				echo "<div class='mainbarmenu'><a href='formregister.php'>Register</a></div>";
			}		
		?>		
		<div id="mainbarhome"><a href="index.php">Home</a></div>

	</div>
	<br><br><br>
	<?php
	if(isset($_SESSION['cmd'])){
		echo $_SESSION['cmd'];
	}
if (isset($_SESSION['userid_login']))
	{
		echo "<br><br><br>";
		$mysqli = new mysqli("localhost","123448","phi006072","123448");
		$query = mysqli_query($mysqli, "SELECT * from items");
		$arr = mysqli_num_rows($query);
		$dataperpage = 10;
		$pages = ceil($arr/$dataperpage);
		if (isset($_GET['start']))
		{
			$start = (($_GET['start']-1)*$dataperpage);
		}
		else 
		{
			$start = 0;
		}
		$mysqli->close();

		echo "<br>";
		echo "<table border='1'>";
		
		$mysqli = new mysqli("localhost","123448","phi006072","123448");
		$result = mysqli_query($mysqli,"SELECT i.*,u.iduser as namaUser FROM items i inner join users u on i.iduser_owner = u.iduser limit $start, $dataperpage");

		if(mysqli_num_rows($result)>0){
			while ($row = mysqli_fetch_assoc($result))
			{
				echo "<tr>";
				$iditem = $row['iditem'];
				$ext = $row['image_extension'];
				$imgItem = "imageitems/$iditem.$ext ";
				echo "<td><img src='$imgItem'></td>";

				echo "<td>"."<a href='bidding.php?selecteditem=".$row['iditem']."''>" . $row['name'] . "</a>"."</td>";
				echo "<td>".$row['status']."</td>";
				echo "<td>".$row['price_initial']."</td>";
				echo "<td>".$row['date_posting']."</td>";
				echo "<td>".$row['namaUser']."</td>";
				echo "<td>";
				if ($row['namaUser'] == $_SESSION['userid_login']){
					echo "<a href='ServerUAS.php?delete=$iditem&ext=$ext'>Cancel Item</a>";
				}

				echo "</td></tr>";
			}

			echo "</table>";

			$mysqli->close();
			for($i=1;$i<=$pages;$i++){
				echo "<a href='?start=".$i."''>" . $i . "</a>  &nbsp; ";
			}
		}
	}
?>
</body>
</html>