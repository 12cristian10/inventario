<?php
	/*== Almacenando datos ==*/
    $product_id_del=limpiar_cadena($_GET['product_id_del']);

    /*== Verificando producto ==*/
    $check_producto=conexion();
    $check_producto=$check_producto->query("SELECT * FROM producto WHERE producto_id='$product_id_del'");

    if($check_producto->rowCount()==1){

		$check_pv=conexion();
    	$check_pv=$check_pv->query("SELECT producto_id FROM producto_vendido WHERE producto_id='$product_id_del' LIMIT 1");

		if($check_pv->rowCount()<=0){

    	    $datos=$check_producto->fetch();
    
    	    $eliminar_producto=conexion();
    	    $eliminar_producto=$eliminar_producto->prepare("DELETE FROM producto WHERE producto_id=:id");
    
    	    $eliminar_producto->execute([":id"=>$product_id_del]);
			
    	    if($eliminar_producto->rowCount()==1){
    
    	    	if(is_file("./img/producto/".$datos['producto_foto'])){
    	    		chmod("./img/producto/".$datos['producto_foto'], 0777);
		    		unlink("./img/producto/".$datos['producto_foto']);
    	    	}
    
	            echo '
	                <div class="notification is-info is-light">
	                    <strong>¡PRODUCTO ELIMINADO!</strong><br>
	                    Los datos del producto se eliminaron con exito
	                </div>
	            ';
	        }else{
	            echo '
	                <div class="notification is-danger is-light">
	                    <strong>¡Ocurrio un error inesperado!</strong><br>
	                    No se pudo eliminar el producto, por favor intente nuevamente
	                </div>
	            ';
	        } 
	    }else{
			echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No podemos eliminar el producto ya que se encuentra asociado a una venta 
	            </div>
	        ';

	    }
	$check_pv=null;	

    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PRODUCTO que intenta eliminar no existe
            </div>
        ';
    }
    $check_producto=null;