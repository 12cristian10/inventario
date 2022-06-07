<?php

	/*== Almacenando datos ==*/
    $prove_id_del=limpiar_cadena($_GET['prove_id_del']);

    /*== Verificando proveedor ==*/
    $check_proveedor=conexion();
    $check_proveedor=$check_proveedor->query("SELECT proveedor_id FROM proveedor WHERE proveedor_id='$prove_id_del'");
    
    if($check_proveedor->rowCount()==1){

    	$check_venta=conexion();
    	$check_venta=$check_venta->query("SELECT proveedor_id FROM venta WHERE proveedor_id='$prove_id_del' LIMIT 1");

    	if($check_venta->rowCount()<=0){
    		
	    	$eliminar_proveedor=conexion();
	    	$eliminar_proveedor=$eliminar_proveedor->prepare("DELETE FROM proveedor WHERE proveedor_id=:id");

	    	$eliminar_proveedor->execute([":id"=>$prove_id_del]);

	    	if($eliminar_proveedor->rowCount()==1){
		        echo '
		            <div class="notification is-info is-light">
		                <strong>¡proveedor ELIMINADO!</strong><br>
		                Los datos del proveedor se eliminaron con exito
		            </div>
		        ';
		    }else{
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                No se pudo eliminar el proveedor, por favor intente nuevamente
		            </div>
		        ';
		    }
		    $eliminar_proveedor=null;
    	}else{
    		echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No podemos eliminar el proveedor ya que se encuentra asociado a una venta
	            </div>
	        ';
    	}
    	$check_venta=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El proveedor que intenta eliminar no existe
            </div>
        ';
    }
    $check_proveedor=null;