<?php

	/*== Almacenando datos ==*/
    $client_id_del=limpiar_cadena($_GET['client_id_del']);

    /*== Verificando cliente ==*/
    $check_cliente=conexion();
    $check_cliente=$check_cliente->query("SELECT cliente_id FROM cliente WHERE cliente_id='$client_id_del'");
    
    if($check_cliente->rowCount()==1){

    	$check_venta=conexion();
    	$check_venta=$check_venta->query("SELECT cliente_id FROM venta WHERE cliente_id='$client_id_del' LIMIT 1");

    	if($check_venta->rowCount()<=0){
    		
	    	$eliminar_cliente=conexion();
	    	$eliminar_cliente=$eliminar_cliente->prepare("DELETE FROM cliente WHERE cliente_id=:id");

	    	$eliminar_cliente->execute([":id"=>$client_id_del]);

	    	if($eliminar_cliente->rowCount()==1){
		        echo '
		            <div class="notification is-info is-light">
		                <strong>¡CLIENTE ELIMINADO!</strong><br>
		                Los datos del cliente se eliminaron con exito
		            </div>
		        ';
		    }else{
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                No se pudo eliminar el cliente, por favor intente nuevamente
		            </div>
		        ';
		    }
		    $eliminar_cliente=null;
    	}else{
    		echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No podemos eliminar el cliente ya que se encuentra asociado a una venta
	            </div>
	        ';
    	}
    	$check_venta=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El CLIENTE que intenta eliminar no existe
            </div>
        ';
    }
    $check_cliente=null;