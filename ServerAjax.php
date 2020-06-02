<?php
session_start(); ?>
<?php
function resize_image($file, $ex, $iditem) {
    $prop = getimagesize($file);
    if ($ex == 'jpg')
    {
        $image = imagecreatefromjpeg($file);
    }
    elseif ($ex == 'png')
    {
        $image = imagecreatefrompng($file);
    }
    $width = $prop[0];
    $height = $prop[1];
    $dst = imagecreatetruecolor(300, 300);
    imagecopyresampled($dst, $image, 0, 0, 0, 0, 300, 300, $width, $height);
    if ($ex == 'jpg')
    {
        $end = imagejpeg($dst,"imageitems/$iditem.jpg");
    }
    elseif ($ex == 'png')
    {
        $end = imagepng($dst,"imageitems/$iditem.png");
    }
    return $end;
}
?>
<?php
//date_default_timezone_set("Asia/Jakarta");
   // if (isset($_POST['btnAddItem']))
    //{
        $mysqli = new mysqli("localhost","root","","projectpweb");
        $user = $_SESSION['userid_login'];
        $path = $_FILES['file']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $stmt =  $mysqli->prepare("INSERT INTO items (iduser_owner,name,price_initial,image_extension) VALUES(?,?,?,?)");
        $stmt->bind_param("ssds",$_SESSION['userid_login'],$_POST['name'],$_POST['price_initial'], $ext);
        $stmt->execute();
        $stmt->close();
        //$con->query($sql);

        //$sql2 ="SELECT iditem FROM items WHERE iduser_owner = '$_SESSION['userid_login']' ORDER BY iditem DESC LIMIT 1";
        $result = mysqli_query($mysqli,"SELECT iditem FROM items WHERE iduser_owner = '$user' ORDER BY iditem DESC LIMIT 1");

        //$res1 = $con->query($sql2);
        if($row = mysqli_fetch_assoc($result)){    
            $iditem = $row['iditem'];
                if($ext == 'jpg' || $ext == 'png') {
                    $path = "imageItems";
                    $filename = $iditem.".".$ext;
                    $destination = $path."/".$filename;
                    move_uploaded_file($_FILES['file']['tmp_name'], $destination);
                    $img = resize_image($destination, $ext, $iditem);
                    //imagepng($img,$destination);
                } 
                else {
                    echo "Tipe file tidak sesuai";
                }
        }
        echo "You are success add your item";
        $mysqli->close(); 
    //} 
    ?>