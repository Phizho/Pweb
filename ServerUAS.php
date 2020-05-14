<?php 
	SESSION_start();

	if(isset($_POST['btnlogin'])){
		$userid = addslashes($_POST['userid']);
		$password = $_POST['pwd'];
		$mysqli = new mysqli("localhost","root","","projectpweb");
		//$query="SELECT * from users WHERE iduser = '$userid'";
		$res = mysqli_query($mysqli, "SELECT * from users WHERE iduser = '$userid'");
		echo "9";
		if(mysqli_num_rows($res) > 0){
			echo "12";
			$row = mysqli_fetch_assoc($res);
			$salt = $row['salt'];
			$passwordcheck = $row['password'];
			$password = sha1(sha1($password).$salt);
			if($passwordcheck == $passwordcheck){
				$_SESSION['userid_login'] = $row['iduser'];
				$_SESSION['password_login'] = $row['password'];
				$mysqli->close();
				echo "Login success";
			}
			else{
				$_SESSION['error'] = "userid and password are false. Please try again.";
				header("location: formlogin.php");
				$mysqli->close();
			}
		}
		else{
			$_SESSION['error'] = "userid and password are false. Please try again.";
			header("location: formlogin.php");
			$mysqli->close();
		}
	}
	elseif(isset($_POST['btnadd'])){
		$username = addslashes($_POST['username']);
		$password = $_POST['password'];
		$passwordulang = $_POST['passwordulang'];
		$userid = addslashes($_POST['userid']);
		if($password != $passwordulang) header("location: formregister.php");
		$mysqli = new mysqli("localhost","root","","projectpweb");
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
?>