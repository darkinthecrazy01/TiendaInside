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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tblproducto (strNombre, strSEO, dbPrecio, intEstado, intCategoria, strImagen, strSubcategoria) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['strSEO'], "text"),
                       GetSQLValueString($_POST['dbPrecio'], "double"),
                       GetSQLValueString($_POST['intEstado'], "int"),
                       GetSQLValueString($_POST['intCategoria'], "int"),
					   GetSQLValueString($_POST['strImagen'], "text"),
					   GetSQLValueString($_POST['strSubcategoria'], "text"));
					   

  mysql_select_db($database_conexionInsite, $conexionInsite);
  $Result1 = mysql_query($insertSQL, $conexionInsite) or die(mysql_error());

  $insertGoTo = "productos_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexionInsite, $conexionInsite);
$query_ConsultaCategorias = "SELECT * FROM tblcategoria ORDER BY tblcategoria.strDescripcion ASC";
$ConsultaCategorias = mysql_query($query_ConsultaCategorias, $conexionInsite) or die(mysql_error());
$row_ConsultaCategorias = mysql_fetch_assoc($ConsultaCategorias);
$totalRows_ConsultaCategorias = mysql_num_rows($ConsultaCategorias);

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
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
<link href="../estilo/BlogPostAssets/styles/blogPostStyle.css" rel="stylesheet" type="text/css" />
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
<!-- InstanceBeginEditable name="head" -->
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
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
    
	<h1>A&ntilde;adir Producto </h1>
	<p>&nbsp;
	  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
	    <table width="353" align="center">
	      <tr valign="baseline">
	        <td width="84" align="right" nowrap="nowrap">Nombre:</td>
	        <td width="249"><span id="sprytextfield1">
	          <input type="text" name="strNombre" value="" size="32" />
	          <span class="textfieldRequiredMsg">Necesario</span></span>
	          *</td>
	        </tr>
	      <tr valign="baseline">
	        <td nowrap="nowrap" align="right">Modelo:</td>
	        <td><span id="sprytextfield2">
	          <input type="text" name="strSEO" value="" size="32" />
	          <span class="textfieldRequiredMsg">Necesario</span></span>
	          *</td>
	        </tr>
	      <tr valign="baseline">
	        <td nowrap="nowrap" align="right">Precio:</td>
	        <td><span id="sprytextfield3">
	          <input name="dbPrecio" type="text" value="" size="32" />
	          <span class="textfieldRequiredMsg">Necesario</span></span>
	          *</td>
	        </tr>
	      <tr valign="baseline">
	        <td nowrap="nowrap" align="right">Imagen:</td>
	        <td><label for="strImagen"></label>
	          <input type="text" name="strImagen" id="strImagen" />
	          <input type="button" name="button" id="button" value="Subir Imagen" onclick="javascript:subirimagen();"/></td>
	        </tr>
	      <tr valign="baseline">
	        <td nowrap="nowrap" align="right">Estado:</td>
	        <td><select name="intEstado">
	          <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Activo</option>
	          <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Inactivo</option>
	          </select></td>
	        </tr>
	      <tr valign="baseline">
	        <td nowrap="nowrap" align="right">Categoria:</td>
	        <td><label for="intCategoria"></label>
	          <select name="intCategoria" id="intCategoria">
	            <?php
do {  
?>
	            <option value="<?php echo $row_ConsultaCategorias['idCategoria']?>"><?php echo $row_ConsultaCategorias['strDescripcion']?></option>
	            <?php
} while ($row_ConsultaCategorias = mysql_fetch_assoc($ConsultaCategorias));
  $rows = mysql_num_rows($ConsultaCategorias);
  if($rows > 0) {
      mysql_data_seek($ConsultaCategorias, 0);
	  $row_ConsultaCategorias = mysql_fetch_assoc($ConsultaCategorias);
  }
?>
              </select></td>
	        </tr>
	      <tr valign="baseline">
	        <td nowrap="nowrap" align="right">Subcategoria:</td>
	        <td><label for="textfield"></label>
	          <label for="strSubcategoria"></label>
	          <select name="strSubcategoria" id="strSubcategoria">
	            <?php
do {  
?>
	            <option value="<?php echo $row_ConsultaSubcategoria['strDescripcion']?>"><?php echo $row_ConsultaSubcategoria['strDescripcion']?></option>
	            <?php
} while ($row_ConsultaSubcategoria = mysql_fetch_assoc($ConsultaSubcategoria));
  $rows = mysql_num_rows($ConsultaSubcategoria);
  if($rows > 0) {
      mysql_data_seek($ConsultaSubcategoria, 0);
	  $row_ConsultaSubcategoria = mysql_fetch_assoc($ConsultaSubcategoria);
  }
?>
              </select></td>
	        </tr>
	      <tr valign="baseline">
	        <td nowrap="nowrap" align="right">&nbsp;</td>
	        <td><input type="submit" value="Insertar Producto" /></td>
	        </tr>
	      </table>
	    <input type="hidden" name="MM_insert" value="form1" />
	    </form>
	  <p>&nbsp;</p>
	  </h3>
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
    </script>
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
mysql_free_result($ConsultaCategorias);

mysql_free_result($ConsultaSubcategoria);
?>
