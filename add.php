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
	<input type='submit' name='btnback' value='back'>
</form>
<script type="text/javascript">
    $("#frmadditem").ajaxForm(function() {
        let myForm = document.getElementById('frmadditem');
        let frmData = new FormData(myForm);
            
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
