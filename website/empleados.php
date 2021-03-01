<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarDatos.php");
require_once ("paginacion_consulta.php");


if (!isset($_SESSION['login']))
	Header("Location: login.php");
else {
	if (isset($_SESSION["datos"])) {
		$empleado = $_SESSION["datos"];
		unset($_SESSION["datos"]);
	}

	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion_emp"]))
		$paginacion = $_SESSION["paginacion_emp"];
	
	$pagina_seleccionada = isset($_GET["PAG_NUM_E"]) ? (int)$_GET["PAG_NUM_E"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM_E"] : 1);
	$pag_tam = 10;

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion_emp"]);

	$conexion = crearConexionBD();

	// La consulta que ha de paginarse
	$query = 'SELECT NOMBRE, APELLIDOS, DNIE, EMAIL ' 
			. 'FROM EMPLEADOS '
			. 'WHERE IDRANGO != 2 ' 
			. 'ORDER BY APELLIDOS, NOMBRE';

	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
	// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
	$total_registros = total_consulta($conexion, $query); //da error
	$total_paginas = (int)($total_registros / $pag_tam);	

	if ($total_registros % $pag_tam > 0)		$total_paginas++;

	if ($pagina_seleccionada > $total_paginas)		$pagina_seleccionada = $total_paginas;

	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
	$paginacion["PAG_NUM_E"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion_emp"] = $paginacion;

	$filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam); //da error

	cerrarConexionBD($conexion);
}
?>

<!DOCTYPE html>
<html>
	
<body>

	<?php include_once ("menu.php"); ?>	
	
	<div class="contenido">
  		<div class="row">

    		
    			<div class="card">
					<div class="size5 blackclass smallercaps"> Empleados </div>
        			    				
    				
    				
        			<div class="table" id="results">
				    	<div class='theader'>
				            <div class='table_header'>Nombre</div>
				            <div class='table_header'>Apellidos</div>
				            <div class='table_header'>DNI</div>
				        </div>
				        
				        <?php
						foreach($filas as $fila) {
							?>
				
				          	<div class='table_row'>
				            	<div class='table_small'>
				              		<div class='table_cell'>Nombre</div>
				              		<div class='table_cell'>
				              			<a href="empleado.php?EMAIL=<?php echo $fila['EMAIL'];?>"><?php echo $fila["NOMBRE"]; ?></a>
				              		</div>
			            		</div>
					            <div class='table_small'>
					              <div class='table_cell'>Apellidos</div>
					              <div class='table_cell'><?php echo $fila["APELLIDOS"]; ?></div>
					            </div>
					            <div class='table_small'>
					              <div class='table_cell'>DNI</div>
					              <div class='table_cell'><?php echo $fila["DNIE"]; ?></div>
					            </div>
				         	</div>
				          
				          <?php
						}
					?>
	
						</div> 	
						 	
							
							<!-- pagination -->
						<nav>	
							<div class="centered pagination" id="enlaces">
								<?php
									for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )
										if ( $pagina == $pagina_seleccionada) { 	?>
											<span class="current"><?php echo $pagina; ?></span>
								<?php }	else { ?>
											<a href="index.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
								<?php } ?>
							</div>
						</nav>	
						
							
						<div class="row">
						  		  <!-- button 1 -->
							      <div class="leftcolumn col-12 col-s-12 centered">
							      		<form method="get" action="anyadirEmpleado.php"><button class="button button4 centerText"
						                    type="submit">Añadir</button></form>
							      </div>
						</div>
					
			    	
				</div>
	</div>
</div>

<?php
include_once ("pie.php");
?>

</body>
</html>
