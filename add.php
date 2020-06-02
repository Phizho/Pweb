<?php session_start();?>
	<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
	<form id="frmadditem" enctype="multipart/form-data" method="POST">
	Nama Barang: <input type="text" name="name" id="name"/><br>
	Price Initial: <input type="text" name="price_initial"/><br>
	<p><label>File Gambar :</label>
        <input id="file" type="file" name="file" accept=".jpg,.png" required="">
    </p>
	<input type="submit" name="btnAddItem" id="btnAddItem"/>
</form>
<form method='post' action='ServerUAS.php'>
	<input type='submit' name='btnback' value='btnback'>
</form>
<script type="text/javascript">
    $("#frmadditem").ajaxForm(function() {
        let myForm = document.getElementById('frmadditem');
        let frmData = new FormData(myForm);
        /*var frmData = new FormData();
        var files = $('#file')[0].files[0];
        frmData.append('file',files); 
        frmData.append('name',)*/
            
        $.ajax({
            url: "ServerAjax.php",
            type: "POST",
            data: frmData,
            async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            success: function(result) {
                alert(result);
                $( '#frmadditem' ).each(function(){
                this.reset();
                });
            }
        });
    });
</script>   


<?php
//date_default_timezone_set("Asia/Jakarta");
  /*  if (isset($_POST['btnAddItem']))
    {
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
                    //$img = resize_image($destination);
                    //imagepng($img,$destination);
                } 
                else {
                    echo "Tipe file tidak sesuai";
                }
        }
        echo "You are success add your item";
        $mysqli->close(); 
    } */
    ?>

