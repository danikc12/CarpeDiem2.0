<?php if (!isset($_SESSION['login']))
	Header("Location: login.php");
?>
<head>
    <link rel="stylesheet" type="text/css" href="diseno.css">    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
  	<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
  	<script src="js/filter.js" type="text/javascript"></script> -->
</head>

	<header id="sidebar" class="padding2">
     <div class="row">	
    	<div class="leftcolumn centered-s centered-xs col-s-12 col-xs-12">
	      	<p>
	  			<span class="uppercase size3"> Agencia de viajes 
	  				<span class="blackclass"> CarpeDiem </span>
  				</span>
	    	</p>
    	</div>

    	<div class="rightcolumn right centered-s centered-xs col-s-12 col-xs-12 right">
      		<!-- start nav -->
  			<nav id="menu" class="right centered">
  				<!-- start menu -->
  				<ul class="">
  					<li class="col-xs-12"><a href="https://flights.google.com"> <span class="submenutext uppercase">&nbsp; 
  						Busca en google &nbsp;&vert;</span></a></li>  					
	  				<!--<li><a href="about.php">Sobre nosotros</a></li> -->
								    
				    	<li class="col-xs-6"><a href="index.php"><span class="submenutext uppercase">&nbsp; Clientes &nbsp;&vert;</span></a>
				      		<!-- start menu desplegable -->
				  		<!-- end menu desplegable -->
				   	</li>
				    
				    	<li class="col-xs-6"><a href="empleado.php?EMAIL=<?php echo $_SESSION['login'];?>" class="submenutext blackclass uppercase">&nbsp;Mi perfil</a>
				  		<!-- start menu desplegable -->
				   		<ul>
					     	
					     	<?php if (isset($_SESSION['login'])) {	?>
								<li><a href="logout.php"> <span class="submenutext uppercase">Cerrar sesion</span></a></li>
			
								<?php if ($_SESSION['cargo']==2) {	?>
	
									<li><a href="empleados.php"><span class="submenutext uppercase"> Empleados </span></a></li>
	
								<?php } ?>
							<?php } ?>					     
					   	</ul>
				  		<!-- end menu desplegable -->
				   	</li>
			 	</ul>
    	
    
  			</nav>
		</div>
	</div>
  </header>

