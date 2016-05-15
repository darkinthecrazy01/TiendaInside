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

mysql_select_db($database_conexionInsite, $conexionInsite);
$query_Recordset1 = "SELECT * FROM tblcategoria ORDER BY tblcategoria.strDescripcion";
$Recordset1 = mysql_query($query_Recordset1, $conexionInsite) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<style type="text/css">
.Negrita {
	font-weight: bold;
}
</style>

Categorias <p>
<?php do { ?>
  <a href="subcategoria_ver.php?cat=<?php echo $row_Recordset1['idCategoria']; ?>"><?php echo $row_Recordset1['strDescripcion']; ?></a><br>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
<p>
  <?php
mysql_free_result($Recordset1);
?>
<p>
  <?php 
  if ((isset($_SESSION['MM_Username'])) && ($_SESSION['MM_Username'] != ""))
  {
    echo "Bienvenido: ";
	?>
<p>
  <?php
	echo ObtenerNombreUsuario($_SESSION['MM_idUsuario']);
	?>
  <br />
<p>
<a href="carrito_lista.php" class="modificacionusuario"> Lista de Compra</a> </p>
<p><a href="usuario_modificar.php" class="modificacionusuario">Modificar Datos</a></p>
<p><a href="usuario_cerrarsesion.php" class="modificacionusuario">Cerrar Sesion</a>
  <?php
    }
  else
  {?><br/>
  <a href="alta_usuario.php">Registrarme</a></p>
<p> <a href="acceso.php">Iniciar Sesion</a> </p>
  <?php } ?>
