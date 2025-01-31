<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";
    
    $campos="producto.producto_id,producto.producto_codigo,producto.producto_nombre,producto.producto_peso,producto.producto_precio,producto.producto_stock,producto_vendido.pv_id,producto_vendido.producto_id,producto_vendido.pv_stock,producto_vendido.pv_total,producto_vendido.venta_codigo";

    $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM producto_vendido INNER JOIN producto ON producto_vendido.producto_id=producto.producto_id ORDER BY producto_vendido.venta_codigo ASC LIMIT $inicio,$registros";
	

	$conexion=conexion();

	$datos = $conexion->query($consulta);

	$datos = $datos->fetchAll();

	$total = $conexion->query("SELECT FOUND_ROWS()");
	$total = (int) $total->fetchColumn();

	$Npaginas =ceil($total/$registros);

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
                    <th colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
	';

	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){
			$tabla.='
				<tr class="has-text-centered" >
					<td>'.$contador.'</td>
                    <td>'.$rows['producto_nombre'].'</td>
                    <td>'.$rows['producto_codigo'].'</td>
                    <td>'.$rows['producto_peso'].'</td>
                    <td>'.$rows['producto_precio'].'</td>
                    <td>'.$rows['pv_stock'].'</td>
                    <td>'.$rows['pv_total'].'</td>
                    <td>
                        <a href="" class="button is-link is-rounded is-small">Ver productos</a>
                    </td> 
                    <td>
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
					<td colspan="5">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haga clic acá para recargar el listado
						</a>
					</td>
				</tr>
			';
		}else{
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="7">
						No hay registros en el sistema
					</td>
				</tr>
			';
		}
	}


	$tabla.='</tbody></table></div>';

	if($total>0 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Mostrando categorías <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}