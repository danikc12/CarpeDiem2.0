<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarDatos.php");
require_once ("paginacion_consulta.php");


// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	unset($_SESSION['formulario']);
	unset($_SESSION['errores']);
	
	if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];
	
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = 10;

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();

	// La consulta que ha de paginarse
	$query = 'SELECT NOMBRE, APELLIDOS, DNIC ' 
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

	$idTransportes = transportes($conexion); 
	$i = 0;
	$destino = array(array());
	foreach ($idTransportes as $id){
				$j = $i;		
  				$destino[$j][0] = destino($conexion, $id[0]);
				$destino[$j][1] = $id[1];
				$i = $i +1;
	}
	
	cerrarConexionBD($conexion);

?>




<!DOCTYPE html>
<html>
	
  
<body>
	<?php include_once ("menu.php"); ?>
	<div class="contenido">
	  <div class="row">
	
	    <div class="leftcolumn col-8 col-s-12">
	    	<div class="card">
	    		<!-- title -->
				<div class="size5 blackclass smallercaps">Area clientes</div>
	
				
		        <!-- Tabla -->   
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
		              	<a href="cliente.php?DNIC=<?php echo $fila['DNIC'];?>"><?php echo $fila["NOMBRE"]; ?></a>
		              </div>
		            </div>
		            <div class='table_small'>
		              <div class='table_cell'>Apellidos</div>
		              <div class='table_cell'><?php echo $fila["APELLIDOS"]; ?></div>
		            </div>
		            <div class='table_small'>
		              <div class='table_cell'>DNI</div>
		              <div class='table_cell'><?php echo $fila["DNIC"]; ?></div>
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
								<div class="current"><?php echo $pagina; ?></div>
					<?php }	else { ?>
								<a href="index.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				</div>
			</nav>	
		

			<!-- buttons -->
			
			<div class="row">
			  		  <!-- button 1 -->
				      <div class="leftcolumn col-12 col-s-12 centered">
				      		<a href="anyadirCliente.php" class="col-4 button button4 centerText"> Añadir </a>				      		
				      </div>
			</div>
			
			<!-- end buttons -->
			
		</div>
	  </div>
	
			<!-- calendar -->		
	
			<div class="rightcolumn centered col-4 col-s-12">
		
			      <iframe src="https://calendar.google.com/calendar/embed?src=ur2fdh9ijuupq9e8f4ss2e7nmo%40group.calendar.google.com&ctz=Europe%2FMadrid" 
			      style="border: none" width="100%" height="500px" frameborder="0" scrolling="no"></iframe>
	         
	       </div> <!-- end rightcolumn -->
	          
	          
	   </div> <!-- end row -->
	   
	   
	   <div class="row">      	      	   
	   
   			  <div class="card col-4 col-s-12 right">	   	
	   	      	
		          <div class="size5 smallercaps blackclass">Viajes proximos</div>
		          <div class="margin-left1">  
		            
		            <?php 
		            if(!($destino == array(array()))){
		            	foreach ($destino as $d){
		            		foreach ($d[0] as $fd){ 
		            			$idClientes = idClientePorViaje($conexion,$d[1]); 
		            			foreach ($idClientes as $cliente) {
		            			?>
		            			
  						<div><a href="pagViajes.php?IDVIAJE=<?php echo "$d[1]";?>&IDCLIENTE=<?php echo "$cliente[0]";?>">
  							<?php print_r($fd[0]); ?></a></div>	  				 	
  			 		<?php }}}
		            }else{ ?>
		            	<div> No hay viajes en los proximos 15 días proximos. </div>
		            <?php } ?>
		            
  		 	  	  </div>
			    	
	          </div>

		</div>
			
		</div>
		</div> <!-- end row -->
		
		
		
	   
		
	</div> <!-- end contenido -->
	
	
		
	
	
	<?php include_once ("pie.php"); ?>
	

</body>
</html>
