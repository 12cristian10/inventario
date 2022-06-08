<?php
require_once "./php/main.php";

    $num_categorias=conexion();
    $num_categorias=$num_categorias->query("SELECT COUNT(categoria_id) AS categorias FROM categoria");
    
    if($num_categorias->rowCount()>0){
        $cantidad_categoria=$num_categorias->fetch();
        $cont_categoria=$cantidad_categoria['categorias'];
    }else{
        $cont_categoria=0;
    }
    $num_categorias=null;
    
    $num_proveedores=conexion();
    $num_proveedores=$num_proveedores->query("SELECT COUNT(proveedor_id) AS proveedores FROM proveedor");
    
    if($num_proveedores->rowCount()>0){
        $cantidad_proveedor=$num_proveedores->fetch();
        $cont_proveedor=$cantidad_proveedor['proveedores'];
    }else{
        $cont_proveedor=0;
    }
    $num_proveedores=null;
    
    $num_usuarios=conexion();
    $num_usuarios=$num_usuarios->query("SELECT COUNT(usuario_id) AS usuarios FROM usuario");
    
    if($num_usuarios->rowCount()>0){
        $cantidad_usuario=$num_usuarios->fetch();
        $cont_usuario=$cantidad_usuario['usuarios'];
    }else{
        $cont_usuario=0;
    }
    $num_usuarios=null;
    
    $num_productos=conexion();
    $num_productos=$num_productos->query("SELECT COUNT(producto_id) AS productos FROM producto");
    
    if($num_productos->rowCount()>0){
        $cantidad_producto=$num_productos->fetch();
        $cont_producto=$cantidad_producto['productos'];
    }else{
        $cont_producto=0;
    }
    $num_productos=null; 

    $consulta="SELECT * FROM producto ";

    $conexion=conexion();
    $datos = $conexion->query($consulta);

    $datos = $datos->fetchAll();
    $conexion=null;

    $consulta="SELECT * FROM reportes INNER JOIN producto ON  reportes.producto_id=producto.producto_id";

    $conexion=conexion();
    $reporte = $conexion->query($consulta);

    $reporte = $reporte->fetchAll();
    $conexion=null;
?>