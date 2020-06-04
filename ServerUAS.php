<?php 
	SESSION_start();

	if(isset($_POST['btnlogin'])){
		$userid = addslashes($_POST['userid']);
		$password = $_POST['pwd'];
		$mysqli = new mysqli("localhost","123448","phi006072","123448");
		$res = mysqli_query($mysqli, "SELECT * from users WHERE iduser = $userid");
		if(mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_assoc($res);
			$salt = $row['salt'];
			$passwordcheck = $row['password'];
			$password = sha1(sha1($password).$salt);
			if($passwordcheck == $password){
				$_SESSION['userid_login'] = $row['iduser'];
				$mysqli->close();
				header("location: index.php");
				exit;
			}
			else{
				$_SESSION['error'] = "Userid or password is wrong, please try again.";
				header("location: formlogin.php");
				$mysqli->close();
				exit;
			}
		}
		else{
			$_SESSION['error'] = "Userid or password is wrong, please try again.";
			header("location: formlogin.php");
			$mysqli->close();
			exit;
		}
	}
	elseif(isset($_POST['btnadd'])){
		$username = addslashes($_POST['username']);
		$password = $_POST['password'];
		$passwordulang = $_POST['passwordulang'];
		$userid = addslashes($_POST['userid']);
		if($password != $passwordulang) header("location: formregister.php");
		$mysqli = new mysqli("localhost","123448","phi006072","123448");
		$salt = substr(sha1(SESSION_id().strtotime("now")),0,10);
		$pwd_hash = addslashes(sha1(sha1($password).$salt));

		//$sql1="SELECT iduser from users WHERE iduser = $userid";
		$res = mysqli_query($mysqli, "SELECT iduser from users WHERE iduser = '$userid'");
		if(mysqli_num_rows($res) > 0){
			$_SESSION['error'] = "userid has been used please use another one";
			header("location: formregister.php");
			$mysqli->close();
		}
		else{
			$sql2 = "INSERT into users VALUES ('$userid' , '$username' , '$pwd_hash' , '$salt')";
			if($mysqli->query($sql2) === TRUE){
				header("location: formlogin.php");
				$mysqli->close();
				echo "Account Created";
			}
			else{
				echo "Upss.... something bad happen please input again";
				$mysqli->close();
			}
		}
	}
	 elseif (isset($_POST['btnbid'])) {
 		$mysqli = new mysqli("localhost","123448","phi006072","123448");
		$stmt = $mysqli->prepare("INSERT INTO biddings (iduser, iditem, price_offer) VALUES (?,?,?)");
		$stmt->bind_param("sii",$_SESSION['userid_login'],$_SESSION['iditem'],$_POST['bidval']);
		$stmt->execute();
		$stmt->close();
		$mysqli->close();
		echo "berhasil";
		//header("location: index.php");
 	}
 	elseif (isset($_POST['btnback'])) {
 		header("location: index.php");
 	}
 	elseif (isset($_POST['btnadditem'])) {
 		$mysqli = new mysqli("localhost","123448","phi006072","123448");
		$stmt = $mysqli->prepare("INSERT INTO items (name, price_initial, image_extension, iduser_owner) VALUES (?,?,?,?)");
		$stmt->bind_param("sdss",$_POST['name'],$_POST['price'],$_POST['imgExt'], $_SESSION['userid_login']);
		$stmt->execute();
		$stmt->close();
		$mysqli->close();

		$namaBaru = $_FILES['fileName'];

		if($_FILES['fl']['name']) 	{   	
			//if no errors...
			if(!$_FILES['fl']['error'])	{
				move_uploaded_file($_FILES['fl']['tmp_name'], "gambar/");
				$message = 'Congratulations!  Your file was accepted.';
			} else {
		    	$message = 'Ooops! Your upload triggered the following error: '.$_FILES['fl']['error'];
		}

		} else { die('You did not select any file!'); }
 	}
 	elseif(isset($_GET['userwin'])){
 		$userwin = $_GET['userwin'];
 		$iditem = $_SESSION['iditem'];
		$mysqli = new mysqli("localhost","123448","phi006072","123448");
		mysqli_query($mysqli,"UPDATE biddings SET is_winner=1 where iduser = '$userwin'");
		mysqli_query($mysqli,"UPDATE items SET status='SOLD' where iditem = '$iditem'");
		//header("location: detail.php");
		$mysqli->close();    
	}
	elseif(isset($_GET['log'])){
		session_destroy();
		header("location: index.php");
	}
	elseif(isset($_GET['delete'])){
		$iditem = $_GET['delete'];
		$ext = $_GET['ext'];
		$mysqli = new mysqli("localhost","123448","phi006072","123448");
		mysqli_query($mysqli,"DELETE FROM `items` WHERE `items`.`iditem` = $iditem");
		$path = "imageItems/$iditem.$ext";
		if (file_exists($path)) {
            unlink($path);
            echo "Item Deleted Succesfully";
        }
        echo "<form method='post' action='ServerUAS.php'>
			  	<input type='submit' name='btnback' value='Go Back'>
              </form>";
	}
?>