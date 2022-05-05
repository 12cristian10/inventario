<?php
	/*== Almacenando datos ==*/
    $pv_id_del=limpiar_cadena($_GET['pv_id_del']);

    /*== Verificando usuario ==*/
    $check_pv=conexion();
    $check_pv=$check_pv->query("SELECT pv_id FROM producto_vendido WHERE pv_id='$pv_id_del'");
    
    if($check_pv->rowCount()==1){

   

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
    
    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El producto que intenta eliminar no existe
            </div>
        ';
    }
    $check_pv=null;