<?php
	require_once "../php/main.php";

	/*== Almacenando id ==*/
    $id=limpiar_cadena($_POST['prove_id']);


    /*== Verificando proveedor ==*/
	$check_proveedor=conexion();
	$check_proveedor=$check_proveedor->query("SELECT * FROM proveedor WHERE proveedor_id='$id'");

    if($check_proveedor->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El proveedor no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_proveedor->fetch();
    }
    $check_proveedor=null;

     /*== Almacenando datos ==*/
     $tipo_doc=limpiar_cadena($_POST['proveedor_td']);
     $numero_doc=limpiar_cadena($_POST['proveedor_documento']);
 
     $nombre=limpiar_cadena($_POST['proveedor_nombre']);
 
     $telefono=limpiar_cadena($_POST['proveedor_telefono']);
     $email=limpiar_cadena($_POST['proveedor_email']);
     
     $direccion=limpiar_cadena($_POST['proveedor_direccion']);
     $ciudad=limpiar_cadena($_POST['proveedor_ciudad']);
 
 
     /*== Verificando campos obligatorios ==*/
     if($nombre=="" ||  $tipo_doc=="" || $numero_doc=="" || $telefono=="" || $email=="" || $direccion=="" || $ciudad==""){
         echo '
             <div class="notification is-danger is-light">
                 <strong>¡Ocurrio un error inesperado!</strong><br>
                 No has llenado todos los campos que son obligatorios
             </div>
         ';
         exit();
     }
 


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /*== Actualizar datos ==*/
    $actualizar_proveedor=conexion();
    $actualizar_proveedor=$actualizar_proveedor->prepare("UPDATE proveedor SET proveedor_td=:tipodni,proveedor_documento=:numdni,proveedor_nombre=:nombre,proveedor_telefono=:telefono,proveedor_email=:email,proveedor_direccion=:direccion,proveedor_ciudad=:ciudad WHERE proveedor_id=:id");

    $marcadores=[
        ":id"=>$id,
        ":tipodni"=>$tipo_doc,
        ":numdni"=>$numero_doc,
        ":nombre"=>$nombre,
        ":telefono"=>$telefono,
        ":email"=>$email,
        ":direccion"=>$direccion,
        ":ciudad"=>$ciudad
    ];

    if($actualizar_proveedor->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡proveedor ACTUALIZADA!</strong><br>
                El proveedor se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el proveedor, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_proveedor=null;