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
        $end = imagejpeg($dst,"imageItems/$iditem.jpg");
    }
    elseif ($ex == 'png')
    {
        $end = imagepng($dst,"imageItems/$iditem.png");
    }
    return $end;
}
?>
<?php
        $mysqli = new mysqli("localhost","123448","phi006072","123448");
        $user = $_SESSION['userid_login'];
        $path = $_FILES['file']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $stmt =  $mysqli->prepare("INSERT INTO items (iduser_owner,name,price_initial,image_extension) VALUES(?,?,?,?)");
        $stmt->bind_param("ssds",$_SESSION['userid_login'],$_POST['name'],$_POST['price_initial'], $ext);
        $stmt->execute();
        $stmt->close();

        $result = mysqli_query($mysqli,"SELECT iditem FROM items WHERE iduser_owner = '$user' ORDER BY iditem DESC LIMIT 1");

        if($row = mysqli_fetch_assoc($result)){    
            $iditem = $row['iditem'];
                if($ext == 'jpg' || $ext == 'png') {
                    $path = "imageItems";
                    $filename = $iditem.".".$ext;
                    $destination = $path."/".$filename;
                    move_uploaded_file($_FILES['file']['tmp_name'], $destination);
                    $img = resize_image($destination, $ext, $iditem);
                    echo "You are success add your item";
                } 
                else {
                    echo "Tipe file tidak sesuai";
                }
        }
        
        $mysqli->close();  
    ?>