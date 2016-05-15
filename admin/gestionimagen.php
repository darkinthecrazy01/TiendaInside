<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Subir Imagen</title>
</head>

<body>

<?php if ((isset($_POST["enviado"])) && ($_POST["enviado"] == "form1")) {
	$nombre_archivo = $_FILES['userfile']['name']; //Aqui se toma el nombre del archivo del fichero
	
	move_uploaded_file($_FILES['userfile']['tmp_name'],"../documentos/productos/".$nombre_archivo); //Toma el archivo que se ha elegido y lo guarda con el nombre que nosotros queramos.
	
	?>
    <script>
	opener.document.form1.strImagen.value="<?php echo $nombre_archivo; ?>";
	self.close();
	</script> 
    
    <?php


}


else
?>


<form action="gestionimagen.php" method="post" enctype="multipart/form-data">

  <p>
    <input name="userfile" type="file" />   
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Subir Imagen" />
  </p>
  <input type="hidden" name="enviado" value="form1"</>
</form>
</body>
</html>