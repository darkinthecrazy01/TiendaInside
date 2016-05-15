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

mysql_select_db($database_conexionInsite, $conexionInsite);
$query_DatosUsuarios = "SELECT * FROM tblusuario ORDER BY tblusuario.strNombre ASC";
$DatosUsuarios = mysql_query($query_DatosUsuarios, $conexionInsite) or die(mysql_error());
$row_DatosUsuarios = mysql_fetch_assoc($DatosUsuarios);
$totalRows_DatosUsuarios = mysql_num_rows($DatosUsuarios);
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
	<h2>Lista Usuarios</h2>
    <p>&nbsp;
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
        <tr class="tablaprincipal">
          <td style="text-align: center">Id</td>
          <td style="text-align: center">Nombre</td>
          <td style="text-align: center">Acciones</td>
        </tr>
        <?php do { ?>
          <tr class="brillo">
            <td><a href="usuarios_datos.php?recordID=<?php echo $row_DatosUsuarios['idUsuario']; ?>"> <?php echo $row_DatosUsuarios['idUsuario']; ?>&nbsp; </a></td>
            <td><?php echo $row_DatosUsuarios['strNombre']; ?>&nbsp; </td>
            <td><a href="usuarios_edit.php?recordID=<?php echo $row_DatosUsuarios['idUsuario']; ?>">Editar</a> - <a href="usuarios_delete.php?recordID=<?php echo $row_DatosUsuarios['idUsuario']; ?>">Eliminar</a></td>
          </tr>
          <?php } while ($row_DatosUsuarios = mysql_fetch_assoc($DatosUsuarios)); ?>
      </table>
      <br />
      <?php echo $totalRows_DatosUsuarios ?> Registros Total </p>
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
mysql_free_result($DatosUsuarios);
?>
