<?php
    require_once dirname(__DIR__)."/inc/session_start.php";
    require_once dirname(__DIR__)."/php/main.php";
   
	if(isset($_GET['sale_cod'])){
        $codigo=$_GET['sale_cod'];
    }else{
        $codigo= $_SESSION['venta_codigo'];
    }

        
	    $tabla="";
        
        $campos="producto.producto_id,producto.producto_codigo,producto.producto_nombre,producto.producto_peso,producto.producto_precio,producto.producto_stock,producto_vendido.pv_id,producto_vendido.producto_id,producto_vendido.pv_stock,producto_vendido.pv_total,producto_vendido.venta_codigo";
    
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
	    			<tr class="has-text-centered" >
	    				<td>'.$contador.'</td>
                        <td>'.$rows['producto_nombre'].'</td>
                        <td>'.$rows['producto_codigo'].'</td>
                        <td>'.$rows['producto_peso'].'</td>
                        <td>'.$rows['producto_precio'].'</td>
                        <td>'.$rows['pv_stock'].'</td>
                        <td>'.$rows['pv_total'].'</td> 
                    </tr>
                ';
                $contador++;
	    	}
	    	
    

	    $tabla.='</tbody></table></div>';
    
	    
    
	    $conexion=null;
	    echo $tabla;
    
	    
    
?>
    