<?php 
    require_once dirname(__DIR__)."/inc/session_start.php";
    require_once dirname(__DIR__)."/php/main.php";
      


    date_default_timezone_set("America/Bogota");
    $fecha=date("d/m/Y");
   
    /*== generar codigo ==*/
    $check_code=conexion();
    $check_code=$check_code->query("SELECT venta_id FROM venta ORDER BY venta_id DESC LIMIT 1 "); 
    $datos= $check_code->fetch();
    
    if($check_code->rowCount()>0){
                        
        $code=$datos['venta_id']+1;

        if($code>=0 && $code<=9){
            $codigo='100000000'.$code; 
          
         }
         else{
            if($code>=10 && $code<=99){
                $codigo='10000000'.$code;
            }else{
              
                $codigo='1000000'.$code;  
            
            }

         }
           
                     
    }else{ 
        $limpiar_incremento=conexion();
    	$limpiar_incremento=$limpiar_incremento->prepare("ALTER TABLE venta AUTO_INCREMENT=1");
    
    	$limpiar_incremento->execute();

        $code=1;
        $codigo="100000000". $code;
    } 
    
    $_SESSION['venta_fecha']=$fecha;
    $_SESSION['venta_codigo']=$codigo;
    $_SESSION['venta_factura']=$code;
    $check_codigo=null; 


?>      
<div id="contenido" class="container is-fluid mb-6">
	<h1 class="title">Ventas</h1>
	<h2 class="subtitle">Nueva venta</h2>


  <div  class="container pb-6 pt-6">
    <div id="respuesta2" ></div>
		<div class="columns">
		  <div class="column">
		    <div class="control">
            <label>Numero de venta</label>
            <input class="input" type="text" name="venta_codigo" id="venta_codigo" value="<?php echo $codigo; ?>" readonly required >
        </div>    
			</div> 

      <div class="column">
		    <div class="control">
          <label>Fecha de emision</label>
          <input class="input" type="text" name="venta_fecha" id="venta_fecha" value="<?php echo $fecha; ?>"readonly required >
        </div>    
			</div>
    </div>

    <div class="column">
      <label>Cliente</label><br>
      <div class="select">
        <select name="cliente" id="select_client" required>
        	<option value="" selected disabled>Seleccione un cliente</option>
        	<?php		   
        		$clientes=conexion();
        		$clientes=$clientes->query("SELECT * FROM cliente");
        		if($clientes->rowCount()>0){
        			$clientes=$clientes->fetchAll();
        			foreach($clientes as $row){
        				echo '<option value="'.$row['cliente_id'].'" >'.$row['cliente_nombre'].' '.$row['cliente_apellido'].'</option>';
        			}
        		}
        		$clientes=null;
        	?>
        </select>
      </div>
    </div>

    <?php 
      require_once dirname(__DIR__)."/php/main.php";
      $productos=conexion();
      $productos=$productos->query("SELECT * FROM producto");
      if($productos->rowCount()>0){
    ?>


    <div class="table" id="tabla">
      <h2 class="subtitle">Productos de la venta:</h2>
		  <?php  
		    require_once dirname(__DIR__)."/php/main.php";
        
		  	# Eliminar producto vendido #
     
		  	if(isset($_GET['pv_id_del'])){
		  		require_once dirname(__DIR__)."/php/pv_eliminar.php";
		  	}
	  
		  	if(!isset($_GET['page'])){
		  		$pagina=1;
		  	}else{
		  		$pagina=(int) $_GET['page'];
		  		if($pagina<=1){
		  			$pagina=1;
		  		}
		  	}
	  
		  	$pagina=limpiar_cadena($pagina);
		  	$url="index.php?vista=sale_new&page="; /* <== */
		  	$registros=15;
		  	$busqueda="";
	  
		  	# Paginador de producto vendido #
		  	require_once dirname(__DIR__)."/php/pv_lista.php";

        $obtener_total=conexion();
        $obtener_total=$obtener_total->query("SELECT SUM(pv_stock) AS numproductos,SUM(pv_total) AS total FROM producto_vendido WHERE venta_codigo='$codigo'");
        $venta_total=$obtener_total->fetch();
           
        $total=$venta_total['total'];
        
        $numProductos=$venta_total['numproductos'];
 
        $_SESSION['venta_total']=$total;
        $_SESSION['venta_stock']=$numProductos;
        echo '<h4 class="title is-4">Importe total: '.$total.'</h4>
              <h4 class="title is-4">Nro. de productos: '.$numProductos.'</h4>
              <input type="hidden" id="cantidadPv" value="'.$numProductos.'">';
        $obtener_total=null;

		  ?>	
	 </div> 
    
      <?php
      require_once dirname(__DIR__).'/vistas/add_product.php';
      ?>
    <div class="container pt-4 ">
    <button type="button" id="agregarpv" class="js-modal-trigger button is-info is-rounded" data-target="addNewProduct">Agregar productos</button>
</div> 
    <p class="has-text-centered">
		  <button type="button" id="guardarVenta" class="js-modal-trigger button is-info is-rounded" data-target="addNewSale">Terminar venta</button>
	  </p>    
  </div>

</div>
<?php
}
else{
?>
<div class="container pt-4">
  
  <div class="column pb-6 has-text-centered">
	  <h2 class="subtitle">NO EXISTEN PRODUCTOS REGISTRADOS EN EL SISTEMA</h2>
  </div>

    <div class="columns">
				
		<div class="column">
		    <a href="index.php?vista=product_new" class="button is-success is-rounded">Agregar producto al sistema</a>
		</div>
		<div class="column is-offset-8">
		    <a href="index.php?vista=home" class="button is-link is-rounded">Regresar al menu</a>
		</div>
		
	  
	</div>


</div>

<?php
}
?>

<div id="addNewSale" class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Acciones</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <footer class="modal-card-foot">
      <button id="confirmarVenta" class="button is-success">Guardar venta</button>
      <button id="mostrarVenta" class="button is-success">Guardar y mostrar</button>
      <button id="descartarVenta" class="button">Descartar venta</button>
    </footer>
  </div>
</div>
