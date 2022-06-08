<?php
    require_once dirname(__DIR__)."/php/main.php";
	/*== Almacenando datos ==*/
    $pv_id_del=limpiar_cadena($_GET['pv_id_del']);
   
    /*== Verificando producto ==*/
    $check_pv=conexion();
    $check_pv=$check_pv->query("SELECT * FROM producto_vendido WHERE pv_id='$pv_id_del'");
    
    if($check_pv->rowCount()==1){

		$producto=$check_pv->fetch();
        $stock_descartado=$producto['pv_stock'];
		$producto_id=$producto['producto_id'];
        
        $check_stock=conexion();
		
		$check_stock=$check_stock->query("SELECT * FROM producto WHERE producto_id='$producto_id'");
		if($check_stock->rowCount()>0){
			$check_stock=$check_stock->fetch();
			$stock_actual=$check_stock['producto_stock'];

			$actualizar_producto=conexion();
            $actualizar_producto=$actualizar_producto->prepare("UPDATE producto SET producto_stock=:stock WHERE producto_id=:p_id");
            
            $stock_recuperado=$stock_descartado + $stock_actual;

            $marcadores=[
                ":stock"=>$stock_recuperado,
		    	":p_id"=>$producto_id
            ];
    
		    $actualizar_producto->execute($marcadores);
    
       
            $actualizar_producto=null;

   

    	    $eliminar_pv=conexion();
	        $eliminar_pv=$eliminar_pv->prepare("DELETE FROM producto_vendido WHERE pv_id=:id");
	        $eliminar_pv->execute([":id"=>$pv_id_del]);
	        if($eliminar_pv->rowCount()==1){
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
		    $eliminar_pv=null;

		}
		$check_stock=null;
		    
    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El producto que intenta eliminar no existe
            </div>
        ';
    }
    $check_pv=null;
?>