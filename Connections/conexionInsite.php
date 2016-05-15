<?php if (!isset($_SESSION)) {
  session_start();
}?>

<?php
error_reporting(E_ALL ^ E_DEPRECATED);
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexionInsite = "localhost";
$database_conexionInsite = "tienda_insite";
$username_conexionInsite = "root";
$password_conexionInsite = "";
$conexionInsite = mysql_pconnect($hostname_conexionInsite, $username_conexionInsite, $password_conexionInsite) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
<?php 
if (is_file("includes/funciones.php")){
	include ("includes/funciones.php");
}
else
{
	include ("../includes/funciones.php");
}
?>