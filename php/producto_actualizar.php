<?php
	require_once "../php/main.php";

	/*== Almacenando id ==*/
    $id=limpiar_cadena($_POST['producto_id']);


    /*== Verificando producto ==*/
	$check_producto=conexion();
	$check_producto=$check_producto->query("SELECT * FROM producto WHERE producto_id='$id'");

    if($check_producto->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El producto no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_producto->fetch();
    }
    $check_producto=null;


    /*== Almacenando datos ==*/
    $codigo=limpiar_cadena($_POST['producto_codigo']);
	$nombre=limpiar_cadena($_POST['producto_nombre']);
    $peso=limpiar_cadena($_POST['producto_peso']);
    $peso_unidad=limpiar_cadena($_POST['producto_pu']);
    $volumen=limpiar_cadena($_POST['producto_volumen']);
    $volumen_unidad=limpiar_cadena($_POST['producto_vu']);
    $fecha=limpiar_cadena($_POST['producto_fecha']);

	$precio=limpiar_cadena($_POST['producto_precio']);
	$stock=limpiar_cadena($_POST['producto_stock']);
	$proveedor=limpiar_cadena($_POST['producto_proveedor']);
    $categoria=limpiar_cadena($_POST['producto_categoria']);

	/*== Verificando campos obligatorios ==*/
    if($codigo=="" || $nombre=="" || $proveedor=="" || $precio=="" || $stock=="" || $categoria=="" ){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }
    
    if($peso=="" && $volumen=="" && $fecha==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                la descripcion del producto esta incompleta, debe asignar por lo menos un peso o un volumen o una fecha de caducidad 
            </div>
        ';
        exit();
    } 



    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9- ]{1,70}",$codigo)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El CODIGO de BARRAS no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    
    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    } 

    if((int) $precio<=0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PRECIO debe ser llenado con un valor mayor a 0
            </div>
        ';
        exit();
    }

    if((int) $stock<=0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El STOCK debe ser llenado con un valor mayor a 0
            </div>
        ';
        exit();
    }


 


    /*== Verificando codigo ==*/
    if($codigo!=$datos['producto_codigo']){
	    $check_codigo=conexion();
	    $check_codigo=$check_codigo->query("SELECT producto_codigo FROM producto WHERE producto_codigo='$codigo'");
	    if($check_codigo->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El CODIGO de BARRAS ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_codigo=null;
    }


    /*== Verificando nombre ==*/
    if($nombre!=$datos['producto_nombre']){
	    $check_nombre=conexion();
	    $check_nombre=$check_nombre->query("SELECT producto_nombre FROM producto WHERE producto_nombre='$nombre'");
	    if($check_nombre->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El NOMBRE ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_nombre=null;
    }


    /*== Verificando categoria ==*/
    if($categoria!=$datos['categoria_id']){
	    $check_categoria=conexion();
	    $check_categoria=$check_categoria->query("SELECT categoria_id FROM categoria WHERE categoria_id='$categoria'");
	    if($check_categoria->rowCount()<=0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La categoría seleccionada no existe
	            </div>
	        ';
	        exit();
	    }
	    $check_categoria=null;
    }

        /*== Verificando proveedor ==*/
        if($proveedor!=$datos['proveedor_id']){
            $check_proveedor=conexion();
            $check_proveedor=$check_proveedor->query("SELECT proveedor_id FROM proveedor WHERE proveedor_id='$proveedor'");
            if($check_proveedor->rowCount()<=0){
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El proveedor seleccionado no se encuentra registrado
                    </div>
                ';
                exit();
            }
            $check_proveedor=null;
        }


    /*== Actualizando datos ==*/
    $actualizar_producto=conexion();
    $actualizar_producto=$actualizar_producto->prepare("UPDATE producto SET producto_codigo=:codigo,producto_nombre=:nombre,producto_peso=:peso,producto_pmedida=:unidadp,producto_volumen=:volumen,producto_vmedida=:unidadv,producto_fecha=:caducidad,producto_precio=:precio,producto_stock=:stock,categoria_id=:categoria,proveedor_id=:proveedor WHERE producto_id=:id");

    $marcadores=[
        ":codigo"=>$codigo,
        ":nombre"=>$nombre,
        ":peso"=>$peso,
        ":unidadp"=>$peso_unidad,
        ":volumen"=>$volumen,
        ":unidadv"=>$volumen_unidad,
        ":caducidad"=>$fecha,
        ":precio"=>$precio,
        ":stock"=>$stock,
        ":categoria"=>$categoria,
        ":proveedor"=>$proveedor,
        ":id"=>$id
    ];


    if($actualizar_producto->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡PRODUCTO ACTUALIZADO!</strong><br>
                El producto se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el producto, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_producto=null;