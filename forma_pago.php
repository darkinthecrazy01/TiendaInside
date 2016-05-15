<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Tienda Insite</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="estilo/principal.css" rel="stylesheet" type="text/css" />
<link href="estilo/BlogPostAssets/styles/blogPostStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="header">
    <div class="headerinterior"><img src="documentos/Logo_Insite3.png" width="129" height="88" alt="Tienda_Insite" /> <a>Busca en tu interior lo que quieres encontrar</div></div>
  <div class="subcontenedor">
    <div class="sidebar1">
      <?php include("includes/catalogo.php");?>
      
      <br>
    <!-- end .sidebar1 --></div>
  <div class="content">
    <h1><!-- InstanceBeginEditable name="olantilla" -->Seleccionar Forma de Pago<!-- InstanceEndEditable --></h1>
    <!-- InstanceBeginEditable name="Contenido" -->
    <p>Elige la forma de pago: 
    </p>
    <p>&nbsp;</p>
    <form id="form1" name="form1" method="post" action="finalizar_compra.php">
      <p>
        <input name="radio" type="radio" id="radio" value="1" checked="checked" />
        <label for="radio">PayPal</label>
      </p>
      <p>
        <input type="radio" name="radio" id="radio" value="2" />
        <label for="radio">Transferencia Bancaria</label>
      </p>
      <p>
        <input type="radio" name="radio" id="radio" value="3" />
        <label for="radio">VISA / MasterCard</label>
      </p>
      <p><br />
      </p>
      <form id="form1" name="form1" method="post" action="">
        <input type="submit" name="button" id="button" value="Pagar" />
      </form>
      <p>&nbsp;</p>
    <!-- InstanceEndEditable -->
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <!-- end .content --></div>
     <!-- end .subcontenedor --></div>
  <div class="footer">
    <p>Insite 2015</p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
