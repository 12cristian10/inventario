<?php
	/*== Almacenando datos ==*/
    $sale_id_del=limpiar_cadena($_GET['sale_id_del']);

    /*== Verificando usuario ==*/
    $check_venta=conexion();
    $check_venta=$check_venta->query("SELECT venta_id, venta_codigo FROM venta WHERE venta_id='$sale_id_del'");

    if($check_venta->rowCount()==1){
            
		$datos = $check_venta->fetch(); 
		$eliminar_pv=conexion();
	    $eliminar_pv=$eliminar_pv->prepare("DELETE FROM producto_vendido WHERE venta_codigo=:codigo");
	    $eliminar_pv->execute([":codigo"=>$datos['venta_codigo']]); 
        
		if($eliminar_pv->rowCount()>0){
			
		    $eliminar_venta=conexion();
	        $eliminar_venta=$eliminar_venta->prepare("DELETE FROM venta WHERE venta_id=:id");
	        $eliminar_venta->execute([":id"=>$sale_id_del]);
    
	        if($eliminar_venta->rowCount()<=0){
		        echo '
		            <div class="notification is-info is-light">
		                <strong>¡VENTA ELIMINADA!</strong><br>
		                Los datos de la venta se eliminaron con exito
		            </div>
		        ';
		    }else{
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                No se pudo eliminar la venta, por favor intente nuevamente
		            </div>
		        ';
		    }
		
		    $eliminar_venta=null;
		}else{ 
			echo '
			<div class="notification is-danger is-light">
				<strong>¡Ocurrio un error inesperado!</strong><br>
				No se pudo eliminar la venta, por favor intente nuevamente
			</div>
		';
		}
        
		$eliminar_pv=null;

    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La VENTA que intenta eliminar no existe
            </div>
        ';
    }
    $check_venta=null;