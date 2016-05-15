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
  $updateSQL = sprintf("UPDATE tblcategoria SET strDescripcion=%s WHERE idCategoria=%s",
                       GetSQLValueString($_POST['strDescripcion'], "text"),
                       GetSQLValueString($_POST['idCategoria'], "int"));

  mysql_select_db($database_conexionInsite, $conexionInsite);
  $Result1 = mysql_query($updateSQL, $conexionInsite) or die(mysql_error());

  $updateGoTo = "categorias_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varCategoria_Recordset1 = "0";
if (isset($_GET["recordID"])) {
  $varCategoria_Recordset1 = $_GET["recordID"];
}
mysql_select_db($database_conexionInsite, $conexionInsite);
$query_Recordset1 = sprintf("SELECT * FROM tblcategoria WHERE tblcategoria.idCategoria = %s", GetSQLValueString($varCategoria_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conexionInsite) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
	<h1>Editar Categoria</h1>
	<p>&nbsp;</p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Descripcion:</td>
          <td><input type="text" name="strDescripcion" value="<?php echo htmlentities($row_Recordset1['strDescripcion'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Actualizar Categoria" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1" />
      <input type="hidden" name="idCategoria" value="<?php echo $row_Recordset1['idCategoria']; ?>" />
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
mysql_free_result($Recordset1);
?>
