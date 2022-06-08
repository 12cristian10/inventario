<?php
    require_once dirname(__DIR__)."/inc/session_start.php";

	$codigo=$_SESSION['venta_codigo'];

	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";
    
    $campos="producto.producto_id,producto.producto_codigo,producto.producto_nombre,producto.producto_peso,producto.producto_pmedida,producto.producto_volumen,producto.producto_vmedida,producto.producto_fecha,producto.producto_precio,producto.producto_stock,producto_vendido.pv_id,producto_vendido.producto_id,producto_vendido.pv_stock,producto_vendido.pv_total,producto_vendido.venta_codigo,producto_vendido.precio_unitario";

    $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM producto_vendido INNER JOIN producto ON producto_vendido.producto_id=producto.producto_id WHERE producto_vendido.venta_codigo=$codigo ORDER BY producto_vendido.venta_codigo ASC LIMIT $inicio,$registros";
	

	$conexion=conexion();

	$datos = $conexion->query($consulta);

	$datos = $datos->fetchAll();

	$total = $conexion->query("SELECT FOUND_ROWS()");
	$total = (int) $total->fetchColumn();
    
	echo'<input  type="hidden" name="pv_solicitados" id="pv_solicitados" value="'.$total.'">';

	$Npaginas =ceil($total/$registros);

	$tabla.='
	<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                	<th>#</th>
                    <th>Nombre</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Precio unitario</th>
                    <th>Cantidad vendida</th>
                    <th>Subtotal</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
	';

	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){
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
                    <td class="is-vcentered">
                        <a href="'.$url.$pagina.'&pv_id_del='.$rows['pv_id'].'" class="button is-danger is-rounded is-small">Eliminar</a>
                    </td> 
                    
                </tr>
            ';
            $contador++;
		}
		$pag_final=$contador-1;

	}else{
		if($total>=1){
			$tabla.='
			
				<tr class="has-text-centered" >
					<td colspan="8">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haga clic acá para recargar el listado
						</a>
					</td>
				</tr>
			';
		}
	}


	$tabla.='</tbody></table></div>';

	if($total>0 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Mostrando productos <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}