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

function ObtenerNombreUsuario($Identificador)
{
	global $database_conexionInsite, $conexionInsite;
	mysql_select_db($database_conexionInsite, $conexionInsite);
	$query_ConsultaFuncion = sprintf("SELECT tblusuario.strNombre FROM tblusuario WHERE tblusuario.idUsuario= %s", $Identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionInsite) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
    return $row_ConsultaFuncion['strNombre'];
    mysql_free_result($ConsultaFuncion);
}

//*************************************************

function ObtenerNombreProducto($Identificador)
{
	global $database_conexionInsite, $conexionInsite;
	mysql_select_db($database_conexionInsite, $conexionInsite);
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblproducto WHERE idProducto= %s", $Identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionInsite) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
    return $row_ConsultaFuncion['strNombre'];
    mysql_free_result($ConsultaFuncion);
}

//*************************************************

function ObtenerPrecioProducto($Identificador)
{
	global $database_conexionInsite, $conexionInsite;
	mysql_select_db($database_conexionInsite, $conexionInsite);
	$query_ConsultaFuncion = sprintf("SELECT dbPrecio FROM tblproducto WHERE idProducto = %s", $Identificador);
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionInsite) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
    return $row_ConsultaFuncion['dbPrecio'];
    mysql_free_result($ConsultaFuncion);
}

//*************************************************

function ObtenerIVA()
{
	global $database_conexionInsite, $conexionInsite;
	mysql_select_db($database_conexionInsite, $conexionInsite);
	$query_ConsultaFuncion = "SELECT intIVA FROM tblvariables WHERE idContador = 1";
	$ConsultaFuncion = mysql_query($query_ConsultaFuncion, $conexionInsite) or die(mysql_error());
	$row_ConsultaFuncion = mysql_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
    return $row_ConsultaFuncion['intIVA'];
    mysql_free_result($ConsultaFuncion);
}

function ActualizacionCarrito($varcompra)
{
	global $database_conexionInsite, $conexionInsite;
	mysql_select_db($database_conexionInsite, $conexionInsite);
	
	$updateSQL = sprintf("UPDATE tblCarrito SET intTransaccionEfectuada=%s WHERE idUsuario=%s AND intTransaccionEfectuada = 0",	
	$varcompra,$_SESSION['MM_idUsuario']);
	mysql_select_db($database_conexionInsite, $conexionInsite);	
	$Result1  = mysql_query($updateSQL, $conexionInsite) or die(mysql_error());
}
//*************************************************

//*************************************************


function ConfirmacionPago($tipopago)
{
	global $database_conexionInsite, $conexionInsite;
	mysql_select_db($database_conexionInsite, $conexionInsite);
	
	$insertSQL = sprintf("INSERT INTO tblCompra (idUsuario, fchCompra, intTipoPago, dbTotal) VALUES (%s, NOW(), %s, %s)",GetSQLValueString($_SESSION['MM_idUsuario'],"int"),$tipopago,0);
	$Result1  = mysql_query($insertSQL, $conexionInsite) or die(mysql_error());
	$ultimacompra = mysql_insert_id();
	ActualizacionCarrito($ultimacompra);
}
?>