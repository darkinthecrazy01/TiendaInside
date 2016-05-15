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

$varCategoria_ConsultaSubcategoria = "0";
if (isset($_GET["cat"])) {
  $varCategoria_ConsultaSubcategoria = $_GET["cat"];
}
mysql_select_db($database_conexionInsite, $conexionInsite);
$query_ConsultaSubcategoria = sprintf("SELECT DISTINCT strSubcategoria, intcategoria FROM tblproducto WHERE tblproducto.intCategoria = %s", GetSQLValueString($varCategoria_ConsultaSubcategoria, "int"));
$ConsultaSubcategoria = mysql_query($query_ConsultaSubcategoria, $conexionInsite) or die(mysql_error());
$row_ConsultaSubcategoria = mysql_fetch_assoc($ConsultaSubcategoria);
$totalRows_ConsultaSubcategoria = mysql_num_rows($ConsultaSubcategoria);$varCategoria_ConsultaSubcategoria = "0";
if (isset($_GET["cat"])) {
  $varCategoria_ConsultaSubcategoria = $_GET["cat"];
}
mysql_select_db($database_conexionInsite, $conexionInsite);
$query_ConsultaSubcategoria = sprintf("SELECT DISTINCT strSubcategoria, intcategoria FROM tblproducto WHERE tblproducto.intCategoria = %s", GetSQLValueString($varCategoria_ConsultaSubcategoria, "int"));
$ConsultaSubcategoria = mysql_query($query_ConsultaSubcategoria, $conexionInsite) or die(mysql_error());
$row_ConsultaSubcategoria = mysql_fetch_assoc($ConsultaSubcategoria);
$totalRows_ConsultaSubcategoria = mysql_num_rows($ConsultaSubcategoria);?>

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
    <h1><!-- InstanceBeginEditable name="olantilla" -->Productos<!-- InstanceEndEditable --></h1>
    <!-- InstanceBeginEditable name="Contenido" -->
    <div class="resultadoproductos">
    <?php if ($totalRows_ConsultaSubcategoria > 0) { // Show if recordset not empty ?>
  <?php do { ?>
    <div class="subcategoria"><a href="categoria_ver.php?cat=<?php echo $row_ConsultaSubcategoria['intcategoria']; ?>&sub=<?php echo $row_ConsultaSubcategoria['strSubcategoria']; ?>"><?php echo $row_ConsultaSubcategoria['strSubcategoria']; ?></a><br />
      </div>
    <?php } while ($row_ConsultaSubcategoria = mysql_fetch_assoc($ConsultaSubcategoria)); ?>
      <?php } // Show if recordset not empty ?>
      <?php if ($totalRows_ConsultaSubcategoria == 0) { // Show if recordset empty ?>
        Todavia no hay Productos en esta Categoria.
  <?php } // Show if recordset empty ?>
  </div>
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
mysql_free_result($ConsultaSubcategoria);
?>
