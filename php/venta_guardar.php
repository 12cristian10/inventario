<?php

require_once "../php/main.php";

   $codigo=$_POST['venta_codigo'];
   
	/*== Guardando datos ==*/
    $guardar_venta=conexion();
    $guardar_venta=$guardar_venta->prepare("INSERT INTO venta(venta_codigo) VALUES(:codigo)"); 
    
    $guardar_venta->execute([":codigo"=>$codigo]); 

    
    if($guardar_venta->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡VENTA REGISTRADA!</strong><br>
                La venta se registro con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar la venta, por favor intente nuevamente
            </div>
        ';
    }
   
    $guardar_venta=null;

