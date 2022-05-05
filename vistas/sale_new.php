
<?php 
    require_once "./inc/session_start.php";
    require_once "./php/main.php";
    $code=1;
    $codigo="100000000". $code;
    /*== generar codigo ==*/
    $check_code=conexion();
    $check_code=$check_code->query("SELECT venta_id FROM venta ORDER BY venta_id DESC LIMIT 1 "); 
    $datos= $check_code->fetch();
    if($check_code->rowCount()==1){
                        
        $code=$datos['venta_id']+1;
        
        if($datos['venta_id']<1000 && $datos['venta_id']>99){
            $codigo='1000000'.$code;
         }
         else if($datos['venta_id']<100 && $datos['venta_id']>9){
            $codigo='10000000'.$code;
         }else{
            $codigo='100000000'.$code; 
        }  
                     
    }
    
    $_SESSION['venta_codigo']=$codigo;
    $check_codigo=null;
?>

<div class="container is-fluid mb-6">
	<h1 class="title">Ventas</h1>
	<h2 class="subtitle">Nueva venta</h2>
</div>

<div class="container pb-6 pt-6">

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/venta_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
                    <label>Numero de factura</label>
                    <input class="input" type="text" name="venta_codigo" value="<?php echo $codigo; ?>" readonly required >
                </div>    
			</div>
		</div>
        <div class="columns is-centered py-4">
                <p class="has-text-centered">
			        <button type="submit" class="button is-info is-rounded">Guardar</button>
		        </p>                 
            </div>
	</form>
    <?php
              require './vistas/add_product.php';
              require './vistas/pv_list.php';
        ?>
</div>