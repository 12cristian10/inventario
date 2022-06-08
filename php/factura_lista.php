<?php
    require_once dirname(__DIR__)."/inc/session_start.php";
    require_once dirname(__DIR__)."/php/main.php";
   
	if(isset($_GET['sale_cod'])){
        $codigo=$_GET['sale_cod'];
    }else{
        $codigo= $_SESSION['venta_codigo'];
    }

        
	    $tabla="";
        
        $campos="producto.producto_id,producto.producto_codigo,producto.producto_nombre,producto.producto_peso,producto.producto_pmedida,producto.producto_volumen,producto.producto_vmedida,producto.producto_fecha,producto.producto_precio,producto.producto_stock,producto_vendido.pv_id,producto_vendido.producto_id,producto_vendido.pv_stock,producto_vendido.pv_total,producto_vendido.venta_codigo,producto_vendido.precio_unitario";
    
        $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM producto_vendido INNER JOIN producto ON producto_vendido.producto_id=producto.producto_id WHERE producto_vendido.venta_codigo=$codigo ORDER BY producto_vendido.venta_codigo ASC";
	    
    
	    $conexion=conexion();
    
	    $data = $conexion->query($consulta);
    
	    $data = $data->fetchAll();
    
    
	    $tabla.='
	    <div class="table-container">
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr class="has-text-centered">
                    	<th>#</th>
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Peso</th>
                        <th>Precio unitario</th>
                        <th>Cantidad vendida</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
	    ';
    
	    
	    	$contador=1;
	    	
	    	foreach($data as $rows){
                $tabla.='
				<tr class="has-text-centered">
					<td class="is-vcentered">'.$contador.'</td>
                    <td class="is-vcentered">'.$rows['producto_nombre'].'</td>
                    <td class="is-vcentered">'.$rows['producto_codigo'].'</td>';
                $tabla.='
					<td class="is-vcentered">';
				       if($rows['producto_peso']!=0){
						     $tabla.='<ul><li><strong>Peso: </strong>'.$rows['producto_peso'].' '.$rows['producto_pmedida'].'</li>';	   
					   }
					   if($rows['producto_volumen']!=0){
						$tabla.='<ul><li><strong>Volumen: </strong>'.$rows['producto_volumen'].' '.$rows['producto_vmedida'].'</li>';	   
					   }
					   if($rows['producto_fecha']!="0000-00-00"){
						$tabla.='<ul><li><strong>Fecha de caducidad: </strong>'.$rows['producto_fecha'].'</li>';
					   }
			$tabla.='</ul></td><td class="is-vcentered">'.$rows['precio_unitario'].'</td>
                    <td class="is-vcentered">'.$rows['pv_stock'].'</td>
                    <td class="is-vcentered">'.$rows['pv_total'].'</td>        
                </tr>
            ';
                $contador++;
	    	}
	    	
    

	    $tabla.='</tbody></table></div>';
    
	    
    
	    $conexion=null;
	    echo $tabla;
    
	    
    
?>
    