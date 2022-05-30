<?php
require_once "../inc/session_start.php";
require_once "../php/main.php";

   $codigo=$_POST['venta_codigo'];

   date_default_timezone_set("America/Bogota");
   $fecha=date("Y-m-d");
   $cliente=limpiar_cadena($_POST['cliente']);
   $importe_total=$_SESSION['venta_total'];

    /*== Verificando campos obligatorios ==*/
    if($cliente=="null"){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

   
   $check_producto=conexion();
   $check_producto=$check_producto->query("SELECT venta_codigo FROM producto_vendido WHERE venta_codigo='$codigo'");
   if($check_producto->rowCount()>0){

       
        


        $guardar_venta=conexion();
        $guardar_venta=$guardar_venta->prepare("INSERT INTO venta(venta_codigo,venta_fecha,venta_total,cliente_id) VALUES(:codigo,:fecha,:total,:cliente)"); 
        
        $guardar_venta->execute([":codigo"=>$codigo,
                                ":fecha"=>$fecha,
                                ":total"=>$importe_total,
                                ":cliente"=>$cliente]); 
    
        
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

   }else{
    echo '
    <div class="notification is-danger is-light">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        No se pudo registrar la venta, debido a que no tiene productos asociados
    </div>
';
   }
   $check_producto=null;
   

    

