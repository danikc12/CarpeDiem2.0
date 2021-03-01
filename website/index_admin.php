<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarDatos.php");
require_once ("paginacion_consulta.php");

if (!isset($_SESSION['login']))
	Header("Location: login.php");
else {
	if (isset($_SESSION["datos"])) {
		$libro = $_SESSION["datos"];
		unset($_SESSION["datos"]);
	}

	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];
	
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = 10;

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();

	// La consulta que ha de paginarse
	$query = 'SELECT NOMBRE, APELLIDOS ' 
			. 'FROM CLIENTES ' 
			. 'ORDER BY APELLIDOS, NOMBRE';

	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
	// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
	$total_registros = total_consulta($conexion, $query); //da error
	$total_paginas = (int)($total_registros / $pag_tam);	

	if ($total_registros % $pag_tam > 0)		$total_paginas++;

	if ($pagina_seleccionada > $total_paginas)		$pagina_seleccionada = $total_paginas;

	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;

	$filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam); //da error

	cerrarConexionBD($conexion);
}
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

include_once ("menu.php");
?>



<main>
	 <nav>

		<div id="enlaces">

			<?php

				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

					if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="index_admin.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?>

		</div>
	</nav>
	
		
	<article class="libro">
			<div class="fila_libro">
			<?php

		foreach($filas as $fila) {
			?>
				<div>
					<a href="consulta_libros.php"><?php echo $fila["NOMBRE"] . " " . $fila['APELLIDOS']; ?></a>
				
			</div>
		<?php
		}
	?>
	
			</div>
	</article>
</main>


<?php

include_once ("pie.php");
?>

</body>
</html>