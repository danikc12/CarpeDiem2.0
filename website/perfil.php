<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarDatos.php");
require_once ("gestionarEmpleados.php");


	if (!isset($_SESSION['login']))
		Header("Location: login.php");


	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];
	
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = 10;

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);
	
	$email = $_GET['EMAIL'];
	
	$conexion = crearConexionBD();

	$filas = datosEmpleado($conexion, $email); 
	
	cerrarConexionBD($conexion);

?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->
	
  <title>CarpeDiem:ADMIN</title>
</head>

<body>

<?php

//include_once ("cabecera.php");

include_once ("menu.php");?>

<!DOCTYPE html>
<html>
	
<?php include_once ("menu.php"); ?>
<body>
  <div class="cardPerfil" style="margin-bottom:5%;">
  <div class="row">



<div class="leftcolumn">
      <div class="text-content fuente ">&nbsp;P<small>ERFIL CLIENTE</SMALL></div>

		<?php foreach ($filas as $fila) { ?>
          <div class="cardPerfil2 ">
        <p>  <SPAN CLASS="smalltext"><span class="blackclass">NOMBRE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span> &nbsp;<?php  print_r($fila['NOMBRE']);?></php></span></p>
        <p>  <SPAN CLASS="smalltext"><span class="blackclass">APELLIDOS&nbsp;&nbsp;&nbsp;&nbsp;:</span>&nbsp; <?php  print_r($fila['APELLIDOS']);?></span></p>
        <p>  <SPAN CLASS="smalltext"><span class="blackclass">D.N.I&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>&nbsp;<?php  print_r($fila['DNIE']);?></span></p>
        <p>  <SPAN CLASS="smalltext"><span class="blackclass">FECHA NAC. :</SPAN>&nbsp;<?php print_r($fila['FECHANACIMIENTO']);?></span></p>
        <p>  <SPAN CLASS="smalltext"><span class="blackclass">DOMICILIO&nbsp;&nbsp;&nbsp;&nbsp;:</span>&nbsp;<?php  print_r($fila['DOMICILIO']);?></span></p>
        <p>  <SPAN CLASS="smalltext"><span class="blackclass">POBLACION&nbsp;&nbsp;:</SPAN> &nbsp;<?php  print_r($fila['POBLACION']);?></span></p>
        <p>  <SPAN CLASS="smalltext"><span class="blackclass">EMAIL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>&nbsp;<?php  print_r($fila['EMAIL']);?></span></p>
        <p>  <SPAN CLASS="smalltext"><span class="blackclass">TELEFONO&nbsp;&nbsp;&nbsp;&nbsp;:</span>&nbsp;<?php  print_r($fila['TELEFONO']);?></span></p>
	<?php  }  ?>
</div>






    </div>


<div class="topnav" style="position:sticky">
<div class="footer">
  <h2 style="font-family:AppleGothic; color:white;">G<SMALL>RUPO</S> 1, E<small>SCUELA</small> S<small>UPERIOR</small> D<small>E</small> I<SMALL>NGENIERIA</SMALL> II<SMALL>NFORMATICA</SMALL>,</h2>
</div>

</div>
</body>
</html>
