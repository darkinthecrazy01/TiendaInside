<?php require_once('Connections/conexionInsite.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$varProducto_DatosProducto = "0";
if (isset($_GET["recordID"])) {
  $varProducto_DatosProducto = $_GET["recordID"];
}
mysql_select_db($database_conexionInsite, $conexionInsite);
$query_DatosProducto = sprintf("SELECT * FROM tblproducto WHERE tblproducto.idProducto = %s", GetSQLValueString($varProducto_DatosProducto, "int"));
$DatosProducto = mysql_query($query_DatosProducto, $conexionInsite) or die(mysql_error());
$row_DatosProducto = mysql_fetch_assoc($DatosProducto);
$totalRows_DatosProducto = mysql_num_rows($DatosProducto);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Tienda INSITE</title>
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
    <h1><!-- InstanceBeginEditable name="olantilla" --><?php echo $row_DatosProducto['strNombre']; ?><!-- InstanceEndEditable --></h1>
    <!-- InstanceBeginEditable name="Contenido" -->
    <table width="100%" border="0">
      <tr>
        <td width="50%"><img src="documentos/productos/<?php echo $row_DatosProducto['strImagen']; ?>" width="450" height="450" /></td>
        <td width="50%" valign="top" bgcolor="#D2DDDF"><p><?php echo $row_DatosProducto['strNombre']; ?></p>
          <p>Modelo: <?php echo $row_DatosProducto['strSEO']; ?></p>
          <p>Precio: $<?php echo $row_DatosProducto['dbPrecio']; ?></p>
          <?php if ((isset ($_SESSION['MM_idUsuario'])) && ($_SESSION['MM_idUsuario']!= ""))
		  { ?>
          <p><a href="carrito_add.php?recordID=<?php echo $row_DatosProducto['idProducto']; ?>">Comprar Producto</a></p>
          <?php }
		  else
		  {?>
          <p>Necesitas <a href="alta_usuario.php">darte de alta</a> para comprar.</p>
<?php }?>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
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
<?php
mysql_free_result($DatosProducto);
?>
