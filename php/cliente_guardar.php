<?php
    
    require_once "../php/main.php";

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

    if(verificar_datos("[0-9]{7,40}",$numero_doc)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El numero de documento no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /*== Verificando numero de documento ==*/
    $check_documento=conexion();
    $check_documento=$check_documento->query("SELECT cliente_documento FROM cliente WHERE cliente_documento='$numero_doc'");
    if($check_documento->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                EL DOCUMENTO ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_documento=null;

    /*== Verificando email ==*/
    if($email!=""){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $check_email=conexion();
            $check_email=$check_email->query("SELECT cliente_email FROM cliente WHERE cliente_email='$email'");
            if($check_email->rowCount()>0){
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El correo electrónico ingresado ya se encuentra registrado, por favor elija otro
                    </div>
                ';
                exit();
            }
            $check_email=null;
        }else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    Ha ingresado un correo electrónico no valido
                </div>
            ';
            exit();
        } 
    }

    /*== Guardando datos ==*/
    $guardar_cliente=conexion();
    $guardar_cliente=$guardar_cliente->prepare("INSERT INTO cliente(cliente_td,cliente_documento,cliente_nombre,cliente_apellido,cliente_telefono,cliente_email,cliente_direccion,cliente_ciudad) VALUES(:tipodni,:numdni,:nombre,:apellido,:telefono,:email,:direccion,:ciudad)");

    $marcadores=[
        ":tipodni"=>$tipo_doc,
        ":numdni"=>$numero_doc,
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        ":telefono"=>$telefono,
        ":email"=>$email,
        ":direccion"=>$direccion,
        ":ciudad"=>$ciudad
    ];

    $guardar_cliente->execute($marcadores);

    if($guardar_cliente->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡CLIENTE REGISTRADO!</strong><br>
                El cliente se registro con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el cliente, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_cliente=null;