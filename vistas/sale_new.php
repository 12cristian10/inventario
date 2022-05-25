
<?php 
    require_once "./inc/session_start.php";
    require_once "./php/main.php"; 

    date_default_timezone_set("America/Bogota");
    $fecha=date("d/m/Y");
   
    /*== generar codigo ==*/
    $check_code=conexion();
    $check_code=$check_code->query("SELECT venta_id FROM venta ORDER BY venta_id DESC LIMIT 1 "); 
    $datos= $check_code->fetch();
    
    if($check_code->rowCount()>0){
                        
        $code=$datos['venta_id']+1;
        
        if($datos['venta_id']<1000 && $datos['venta_id']>99){
            $codigo='1000000'.$code;
         }
         else if($datos['venta_id']<100 && $datos['venta_id']>9){
            $codigo='10000000'.$code;
         }else{
            $codigo='100000000'.$code; 
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
    $check_codigo=null;
?>

<div class="container is-fluid mb-6">
	<h1 class="title">Ventas</h1>
	<h2 class="subtitle">Nueva venta</h2>


    <div class="container pb-6 pt-6">

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
                    <label>Numero de venta</label>
                    <input class="input" type="text" name="venta_codigo" value="<?php echo $codigo; ?>" readonly required >
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
        			  <select name="producto" id="select_client" required>
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
        <div>
            <?php
                  require './vistas/add_product.php';
            ?>
        </div>

     
        
    </div> 
</div>
<div class="container is-fluid mb-6">
    <div class="columns is-centered pt-6">
        <p class="has-text-centered">
			<button type="button" id="guardarVenta" class="js-modal-trigger button is-info is-rounded" data-target="addNewSale">Terminar venta</button>
		</p>                 
    </div>
</div> 


<div id="addNewSale" class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Confirmar venta</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
	   
    </section>
    <footer class="modal-card-foot">
      <button id="confirmarVenta" class="button is-success">Confirmar venta</button>
      <button id="mostrarVenta" class="button is-success">Guardar e imprimir venta</button>
      <button id="descartarVenta" class="button">Descartar venta</button>
    </footer>
  </div>
</div>