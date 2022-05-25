<?php
	require_once "../php/main.php";

	/*== Almacenando id ==*/
    $id=limpiar_cadena($_POST['client_id']);


    /*== Verificando cliente ==*/
	$check_cliente=conexion();
	$check_cliente=$check_cliente->query("SELECT * FROM cliente WHERE cliente_id='$id'");

    if($check_cliente->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El cliente no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_cliente->fetch();
    }
    $check_cliente=null;

     /*== Almacenando datos ==*/
     $tipo_doc=limpiar_cadena($_POST['cliente_td']);
     $numero_doc=limpiar_cadena($_POST['cliente_documento']);
 
     $nombre=limpiar_cadena($_POST['cliente_nombre']);
     $apellido=limpiar_cadena($_POST['cliente_apellido']);
 
     $telefono=limpiar_cadena($_POST['cliente_telefono']);
     $email=limpiar_cadena($_POST['cliente_email']);
     
     $direccion=limpiar_cadena($_POST['cliente_direccion']);
     $ciudad=limpiar_cadena($_POST['cliente_ciudad']);
 
 
     /*== Verificando campos obligatorios ==*/
     if($nombre=="" || $apellido=="" || $tipo_doc=="" || $numero_doc=="" || $telefono=="" || $email=="" || $direccion=="" || $ciudad==""){
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

    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El APELLIDO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }


    /*== Actualizar datos ==*/
    $actualizar_cliente=conexion();
    $actualizar_cliente=$actualizar_cliente->prepare("UPDATE cliente SET cliente_td=:tipodni,cliente_documento=:numdni,cliente_nombre=:nombre,cliente_apellido=:apellido,cliente_telefono=:telefono,cliente_email=:email,cliente_direccion=:direccion,cliente_ciudad=:ciudad WHERE cliente_id=:id");

    $marcadores=[
        ":id"=>$id,
        ":tipodni"=>$tipo_doc,
        ":numdni"=>$numero_doc,
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        ":telefono"=>$telefono,
        ":email"=>$email,
        ":direccion"=>$direccion,
        ":ciudad"=>$ciudad
    ];

    if($actualizar_cliente->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡CLIENTE ACTUALIZADA!</strong><br>
                El cliente se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el cliente, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_cliente=null;