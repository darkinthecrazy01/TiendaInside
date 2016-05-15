<?php require_once('../Connections/conexionInsite.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tblproducto SET strNombre=%s, strSEO=%s, dbPrecio=%s, intEstado=%s, strImagen=%s, intCategoria=%s, strSubcategoria=%s WHERE idProducto=%s",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['strSEO'], "text"),
                       GetSQLValueString($_POST['dbPrecio'], "double"),
                       GetSQLValueString($_POST['intEstado'], "int"),
                       GetSQLValueString($_POST['strImagen'], "text"),
                       GetSQLValueString($_POST['intCategoria'], "int"),
                       GetSQLValueString($_POST['strSubcategoria'], "text"),
                       GetSQLValueString($_POST['idProducto'], "int"));

  mysql_select_db($database_conexionInsite, $conexionInsite);
  $Result1 = mysql_query($updateSQL, $conexionInsite) or die(mysql_error());

  $updateGoTo = "productos_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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

mysql_select_db($database_conexionInsite, $conexionInsite);
$query_ConsultaCategoria = "SELECT * FROM tblcategoria ORDER BY tblcategoria.strDescripcion ASC";
$ConsultaCategoria = mysql_query($query_ConsultaCategoria, $conexionInsite) or die(mysql_error());
$row_ConsultaCategoria = mysql_fetch_assoc($ConsultaCategoria);
$totalRows_ConsultaCategoria = mysql_num_rows($ConsultaCategoria);

mysql_select_db($database_conexionInsite, $conexionInsite);
$query_ConsultaSubcategoria = "SELECT * FROM tblsubcategoria ORDER BY tblsubcategoria.strDescripcion ASC";
$ConsultaSubcategoria = mysql_query($query_ConsultaSubcategoria, $conexionInsite) or die(mysql_error());
$row_ConsultaSubcategoria = mysql_fetch_assoc($ConsultaSubcategoria);
$totalRows_ConsultaSubcategoria = mysql_num_rows($ConsultaSubcategoria);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/BaseAdmin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Administracion Principal Inside</title>
<!-- InstanceEndEditable -->
<link href="../estilo/BlogPostAssets/styles/blogPostStyle.css" rel="stylesheet" type="text/css" />
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div id="mainwrapper">
  <header> 
    <!--**************************************************************************
    Header starts here. It contains Logo and 3 navigation links. 
    ****************************************************************************-->
    <div id="logo"><!-- <img src="../images/images.jpg" alt="sample logo"> --><!-- Company Logo text --></div>
    <img src="../documentos/Logo_Insite3.png" width="121" height="101" alt="Tienda_Insite" />
<nav>Administracion de Tienda INSITE</nav
  > 
  </header>
  <div id="content">
    <div class="notOnDesktop"> 
      <!-- This search box is displayed only in mobile and tablet laouts and not in desktop layouts -->
      <input type="text" placeholder="Search" />
    </div>
    <section id="mainContent">  
    <!-- InstanceBeginEditable name="Contenido" -->
	 <script> 
    function subirimagen()
	{
		 self.name = 'opener';  remote = open('gestionimagen.php','remote','width=400,height=150,location=no,scrollbars=yes,menubar=no,toolbars=no,resizable=yes,fullscreen=no,status=yes');  remote.focus();
	}
    
    </script>
    <h1>Editar Producto</h1>
	<p>&nbsp;</p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Nombre:</td>
          <td><input type="text" name="strNombre" value="<?php echo htmlentities($row_DatosProducto['strNombre'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Modelo:</td>
          <td><input type="text" name="strSEO" value="<?php echo htmlentities($row_DatosProducto['strSEO'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Precio:</td>
          <td><input type="text" name="dbPrecio" value="<?php echo htmlentities($row_DatosProducto['dbPrecio'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Estado:</td>
          <td><select name="intEstado">
            <option value="1" <?php if (!(strcmp(1, htmlentities($row_DatosProducto['intEstado'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Activo</option>
            <option value="0" <?php if (!(strcmp(0, htmlentities($row_DatosProducto['intEstado'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Inactivo</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Imagen:</td>
          <td><input type="text" name="strImagen" value="<?php echo htmlentities($row_DatosProducto['strImagen'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" />
            <input type="button" name="button" id="button" value="Subir Imagen" onclick="javascript:subirimagen();"/></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Categoria:</td>
          <td><select name="intCategoria">
            <?php 
do {  
?>
            <option value="<?php echo $row_ConsultaCategoria['idCategoria']?>" <?php if (!(strcmp($row_ConsultaCategoria['idCategoria'], htmlentities($row_DatosProducto['intCategoria'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>><?php echo $row_ConsultaCategoria['strDescripcion']?></option>
            <?php
} while ($row_ConsultaCategoria = mysql_fetch_assoc($ConsultaCategoria));
?>
          </select></td>
        </tr>
        <tr> </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Subcategoria:</td>
          <td><select name="intSubcategoria">
            <?php 
do {  
?>
            <option value="<?php echo $row_ConsultaSubcategoria['idSubcategoria']?>" <?php if (!(strcmp($row_ConsultaSubcategoria['idSubcategoria'], htmlentities($row_DatosProducto['strSubcategoria'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>><?php echo $row_ConsultaSubcategoria['strDescripcion']?></option>
            <?php
} while ($row_ConsultaSubcategoria = mysql_fetch_assoc($ConsultaSubcategoria));
?>
          </select></td>
        </tr>
        <tr> </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Actualizar registro" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1" />
      <input type="hidden" name="idProducto" value="<?php echo $row_DatosProducto['idProducto']; ?>" />
    </form>
    <p>&nbsp;</p>
    <!-- InstanceEndEditable --></section>
    
    <section id="sidebar">
      <div id="adimage"><img src="../documentos/fechas-venta-nocturna-2015.jpg" alt="" width="102%" height="95"/></div>
      <nav>
        <ul>
          <?php include("../includes/cabeceraadmin.php");  
          ?>
        </ul>
      </nav>
    </section>
    <footer><!--************************************************************************
    Footer starts here
    ****************************************************************************-->
      <article>
      <h3>Administraci&oacute;n Inside</h3></article>
    </footer>
  </div>
  <div id="footerbar"><!-- Small footerbar at the bottom --></div>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($DatosProducto);

mysql_free_result($ConsultaCategoria);

mysql_free_result($ConsultaSubcategoria);
?>
