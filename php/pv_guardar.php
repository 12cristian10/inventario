<?php
require_once "../inc/session_start.php";
require_once "../php/main.php";


$codigo=$_SESSION['venta_codigo'];
$producto_id=$_POST['producto'];
$cantidad=limpiar_cadena($_POST['unidades_p']);
$total=0;

/*== Verificando campos obligatorios ==*/
if($cantidad=="" || $producto_id=="null"){
    
	echo '
		<div class="notification is-danger is-light">
			<strong>¡Ocurrio un error inesperado!</strong><br>
			No has llenado todos los campos que son obligatorios
		</div>
	';
	exit();
}

/*== Verificando integridad de los datos ==*/
if((int) $cantidad <=0){
    
	echo '
		<div class="notification is-danger is-light">
			<strong>¡Ocurrio un error inesperado!</strong><br>
			La CANTIDAD REQUERIDA debe ser un valor mayor a 0
		</div>
	';
	exit();
}

   /*==verificando peso ==*/
   $check_cantidad=conexion();
   $check_cantidad=$check_cantidad->query("SELECT producto_stock,producto_precio FROM producto WHERE producto_id = $producto_id");
   if($check_cantidad->rowCount()>0){

	   $resultado = $check_cantidad->fetch();
       
       $stock = $resultado['producto_stock'];
         
	   if($cantidad > $resultado['producto_stock']){
       
		    echo '
		        <div class="notification is-danger is-light">
		        	<strong>¡Ocurrio un error inesperado!</strong><br>
		        	STOCK de productos insuficiente, por favor ingrese otra cantidad
		        </div>
	        ';
	        exit();
	   }else{
           $precio=$resultado['producto_precio'];
           $subtotal=$cantidad*$precio;
        
       }
   	  
   }
   $check_cantidad=null;

   	/*== Guardando datos ==*/
       $guardar_p_sale=conexion();
       $guardar_p_sale=$guardar_p_sale->prepare("INSERT INTO producto_vendido(venta_codigo,producto_id,pv_stock,pv_total) VALUES(:codigo,:id,:cantidad,:sub)");
   
       $marcadores=[
           ":codigo"=>$codigo,
           ":id"=>$producto_id,
           ":cantidad"=>$cantidad,
           ":sub"=>$subtotal
       ];
   
       $guardar_p_sale->execute($marcadores);
    
       if($guardar_p_sale->rowCount()==1){
           
        $stock=$stock-$cantidad;
        $total=$subtotal+$total;
        $actualizar_producto=conexion();
        $actualizar_producto=$actualizar_producto->prepare("UPDATE producto SET producto_stock=:stock WHERE producto_id=:id");

        $marcadores=[
            ":id"=>$producto_id,
            ":stock"=>$stock
        ];
        
        $actualizar_producto->execute($marcadores);
        
           echo '
               <div class="notification is-info is-light">
                   <strong>¡PRODUCTO REGISTRADO!</strong><br>
                   El producto se agrego con exito
               </div>
           ';
       }else{
       
   
           echo '
               <div class="notification is-danger is-light">
                   <strong>¡Ocurrio un error inesperado!</strong><br>
                   No se pudo añadir el producto, por favor intente nuevamente
               </div>
           ';
       }
       $guardar_p_sale=null;
?> 