<?php
if(isset($_POST['descartarVenta'])){
    require_once dirname(__DIR__)."/inc/session_start.php";
    require_once dirname(__DIR__)."/php/main.php";

	$codigo=$_SESSION['venta_codigo'];
     
    /*== Verificando producto ==*/
    $check_pv=conexion();
    $check_pv=$check_pv->query("SELECT DISTINCT producto_id FROM producto_vendido WHERE venta_codigo=$codigo");
    
    if($check_pv->rowCount()>0){

		$producto=$check_pv->fetchAll();

        foreach($producto as $rows){
            
            $producto_id=$rows['producto_id'];
            echo $producto_id;

            $check_stock=conexion();

		    $check_stock=$check_stock->query("SELECT producto.producto_stock, SUM(producto_vendido.pv_stock) AS stock_descartado FROM producto_vendido INNER JOIN producto ON producto_vendido.producto_id=producto.producto_id WHERE producto_vendido.producto_id='$producto_id' AND producto_vendido.venta_codigo=$codigo");
		    if($check_stock->rowCount()>0){

			    $check_stock=$check_stock->fetch();
			    $stock_actual=$check_stock['producto_stock'];
                $stock_descartado=$check_stock['stock_descartado'];

			$actualizar_producto=conexion();
            $actualizar_producto=$actualizar_producto->prepare("UPDATE producto SET producto_stock=:stock WHERE producto_id=:p_id");
            
            $stock_recuperado=$stock_descartado + $stock_actual;

            $marcadores=[
                ":stock"=>$stock_recuperado,
		    	":p_id"=>$producto_id
            ];
    
		    $actualizar_producto->execute($marcadores);
    
       
            $actualizar_producto=null;


		    }

		}

        $eliminar_pv=conexion();
        $eliminar_pv=$eliminar_pv->prepare("DELETE FROM producto_vendido WHERE venta_codigo=:cod");
        $eliminar_pv->execute([":cod"=>$codigo]);
		$eliminar_pv=null;
		$check_stock=null;
		    
    }
    $check_pv=null;
    echo 'cambios descartados';
}
?>	