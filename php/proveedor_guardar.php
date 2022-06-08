<?php
    
    require_once "../php/main.php";

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
    $check_documento=$check_documento->query("SELECT proveedor_documento FROM proveedor WHERE proveedor_documento='$numero_doc'");
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
            $check_email=$check_email->query("SELECT proveedor_email FROM proveedor WHERE proveedor_email='$email'");
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
    $guardar_proveedor=conexion();
    $guardar_proveedor=$guardar_proveedor->prepare("INSERT INTO proveedor(proveedor_td,proveedor_documento,proveedor_nombre,proveedor_telefono,proveedor_email,proveedor_direccion,proveedor_ciudad) VALUES(:tipodni,:numdni,:nombre,:telefono,:email,:direccion,:ciudad)");

    $marcadores=[
        ":tipodni"=>$tipo_doc,
        ":numdni"=>$numero_doc,
        ":nombre"=>$nombre,
        ":telefono"=>$telefono,
        ":email"=>$email,
        ":direccion"=>$direccion,
        ":ciudad"=>$ciudad
    ];

    $guardar_proveedor->execute($marcadores);

    if($guardar_proveedor->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡proveedor REGISTRADO!</strong><br>
                El PROVEEDOR se registro con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el proveedor, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_proveedor=null;