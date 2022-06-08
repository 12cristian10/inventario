<?php
	require_once "../inc/session_start.php";

	require_once "../php/main.php";

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


    /*== Verificando nombre ==*/
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
 

    /*== Verificando categoria ==*/
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
    
    
    /* Directorios de imagenes */
	$img_dir='../img/producto/';


	/*== Comprobando si se ha seleccionado una imagen ==*/
	if($_FILES['producto_foto']['name']!="" && $_FILES['producto_foto']['size']>0){

        /* Creando directorio de imagenes */
        if(!file_exists($img_dir)){
            if(!mkdir($img_dir,0777)){
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        Error al crear el directorio de imagenes
                    </div>
                ';
                exit();
            }
        }

		/* Comprobando formato de las imagenes */
		if(mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/png"){
			echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La imagen que ha seleccionado es de un formato que no está permitido
	            </div>
	        ';
	        exit();
		}


		/* Comprobando que la imagen no supere el peso permitido */
		if(($_FILES['producto_foto']['size']/1024)>3072){
			echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La imagen que ha seleccionado supera el límite de peso permitido
	            </div>
	        ';
			exit();
		}


		/* extencion de las imagenes */
		switch(mime_content_type($_FILES['producto_foto']['tmp_name'])){
			case 'image/jpeg':
			  $img_ext=".jpg";
			break;
			case 'image/png':
			  $img_ext=".png";
			break;
		}

		/* Cambiando permisos al directorio */
		chmod($img_dir, 0777);

		/* Nombre de la imagen */
		$img_nombre=renombrar_fotos($nombre);

		/* Nombre final de la imagen */
		$foto=$img_nombre.$img_ext;

		/* Moviendo imagen al directorio */
		if(!move_uploaded_file($_FILES['producto_foto']['tmp_name'], $img_dir.$foto)){
			echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No podemos subir la imagen al sistema en este momento, por favor intente nuevamente
	            </div>
	        ';
			exit();
		}

	}else{
		$foto="";
	}

    

	/*== Guardando datos ==*/
    $guardar_producto=conexion();
    $guardar_producto=$guardar_producto->prepare("INSERT INTO producto(producto_codigo,producto_nombre,producto_peso,producto_pmedida,producto_volumen,producto_vmedida,producto_fecha,producto_precio,producto_stock,producto_foto,categoria_id,usuario_id,proveedor_id) VALUES(:codigo,:nombre,:peso,:unidadp,:volumen,:unidadv,:caducidad,:precio,:stock,:foto,:categoria,:usuario,:proveedor)");

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
        ":foto"=>$foto,
        ":categoria"=>$categoria,
        ":proveedor"=>$proveedor,
        ":usuario"=>$_SESSION['id']
    ];

    $guardar_producto->execute($marcadores);

    if($guardar_producto->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡PRODUCTO REGISTRADO!</strong><br>
                El producto se registro con exito
            </div>
        ';

        $recolectar_datos=conexion();
        $recolectar_datos=$recolectar_datos->query("SELECT * FROM producto WHERE producto_codigo='$codigo'");
        if($recolectar_datos->rowCount()>0){
        
            $data=$recolectar_datos->fetch();
           $id=$data['producto_id'];
           $fecha_ingreso=$data['producto_ingreso'];
           $cantidad=$data['producto_stock']; 

           $guardar_reporte=conexion();
           $guardar_reporte=$guardar_reporte->prepare("INSERT INTO reportes(fecha_ingreso,cantidad_ingresada,producto_id) VALUES(:ingreso,:unidadesi,:id)");

           $info=[
            ":id"=>$id,
            ":ingreso"=>$fecha_ingreso,
            ":unidadesi"=>$cantidad     
        ];
           
           $guardar_reporte->execute($info);
           $guardar_reporte=null;
        }
        $recolectar_datos=null;
        
    }else{

    	if(is_file($img_dir.$foto)){
			chmod($img_dir.$foto, 0777);
			unlink($img_dir.$foto);
        }

        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el producto, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_producto=null;