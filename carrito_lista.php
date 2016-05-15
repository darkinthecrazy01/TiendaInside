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
?>
<?php
$varUsuario_DatosCarritod = "0";
if (isset($_SESSION["MM_idUsuario"])) {
  $varUsuario_DatosCarritod = $_SESSION["MM_idUsuario"];
}
mysql_select_db($database_conexionInsite, $conexionInsite);
$query_DatosCarritod = sprintf("SELECT * FROM tblcarrito WHERE tblcarrito.idUsuario = %s AND tblcarrito.intTransaccionEfectuada = 0", GetSQLValueString($varUsuario_DatosCarritod, "int"));
$DatosCarritod = mysql_query($query_DatosCarritod, $conexionInsite) or die(mysql_error());
$row_DatosCarritod = mysql_fetch_assoc($DatosCarritod);
$totalRows_DatosCarritod = mysql_num_rows($DatosCarritod);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    <h1><!-- InstanceBeginEditable name="olantilla" -->Lista de Compra<!-- InstanceEndEditable --></h1>
    <!-- InstanceBeginEditable name="Contenido" -->
    <table width="100%" border="0">
      <tr class="tablaprincipal">
        <td>Producto</td>
        <td>Unidades</td>
        <td>Precio</td>
        <td>Acciones</td>
      </tr>
     <?php  $preciototal=0;?>
      <?php do { ?>
        <tr class="brillo">
          <td bgcolor="#FFFFFF"><?php echo ObtenerNombreProducto($row_DatosCarritod['idProducto']); ?></td>
          <td bgcolor="#FFFFFF"><?php echo $row_DatosCarritod['intCantidad']; ?></td>
          <td bgcolor="#FFFFFF">$ <?php echo ObtenerPrecioProducto($row_DatosCarritod['idProducto']); ?></td>
          <td bgcolor="#FFFFFF"><a href="Eliminar_Compra.php?recordID=<?php echo $row_DatosCarritod['intContador']; ?>">Eliminar</a></td>
         </tr>
         <?php $preciototal = $preciototal + ObtenerPrecioProducto($row_DatosCarritod['idProducto']); ?>
        <?php } while ($row_DatosCarritod = mysql_fetch_assoc($DatosCarritod)); ?>
        <tr>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF">SubTotal :</td>
          <td bgcolor="#FFFFFF">$ <?php echo $preciototal; ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF">IVA :</td>
          <td bgcolor="#FFFFFF"><?php echo ObtenerIVA(); ?>%</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF">Valor del IVA :</td>
          <td bgcolor="#FFFFFF">$ <?php 
		  $multiplicador = ObtenerIVA()/100;
		  $valordelIVA = $preciototal * $multiplicador;
		  echo $valordelIVA?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="right" bgcolor="#FFFFFF">Total :</td>
          <td bgcolor="#FFFFFF">$ <?php 
		  $multiplicador = (100 + ObtenerIVA())/100;
		  $valorconIVA = $preciototal * $multiplicador;
		  echo $valorconIVA?></td>
          <td>&nbsp;</td>
        </tr>
    </table>
      <a href="forma_pago.php">Seleccionar forma de pago</a> <!-- InstanceEndEditable -->
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
mysql_free_result($DatosCarritod);
?>
