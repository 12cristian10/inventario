<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";
    
	$campos="venta.venta_id,venta.venta_codigo,venta.venta_fecha,venta.venta_stock,venta.venta_total,cliente.cliente_id,cliente.cliente_nombre,cliente.cliente_apellido,venta.usuario_id,usuario.usuario_nombre,usuario.usuario_apellido";


    
	if(isset($busqueda) && $busqueda!=""){
		$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM venta INNER JOIN cliente ON venta.cliente_id=cliente.cliente_id INNER JOIN usuario ON venta.usuario_id=usuario.usuario_id WHERE venta.venta_codigo LIKE '%$busqueda%' OR cliente.cliente_nombre LIKE '%$busqueda%' OR cliente.cliente_apellido LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' ORDER BY venta.venta_codigo ASC LIMIT $inicio,$registros";
	}else{
		$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM venta INNER JOIN cliente ON venta.cliente_id=cliente.cliente_id INNER JOIN usuario ON venta.usuario_id=usuario.usuario_id ORDER BY venta.venta_codigo ASC LIMIT $inicio,$registros";
	}


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
                    <th>Codigo</th>
                    <th>Fecha</th>
					<th>Cliente</th>
                    <th>Nro. productos</th>
                    <th>Total</th>
					<th>Autor de registo</th>
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
                    <td>'.$rows['venta_codigo'].'</td>
                    <td>'.$rows['venta_fecha'].'</td>
                    <td>'.$rows['cliente_nombre'].' '.$rows['cliente_apellido'].'</td>
					<td>'.$rows['venta_stock'].'</td> 
                    <td>'.$rows['venta_total'].'</td>
					<td>'.$rows['usuario_nombre'].' '.$rows['usuario_apellido'].'</td>
                    <td>
					    <a href="index.php?vista=bill_sale&sale_cod='.$rows['venta_codigo'].'" class="button is-link is-rounded is-small">Mostrar</a>
                    </td>
                    <td>
                        <a href="'.$url.$pagina.'&sale_id_del='.$rows['venta_id'].'" class="button is-danger is-rounded is-small">Eliminar</a>
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
		}else{
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="8">
						No hay registros en el sistema
					</td>
				</tr>
			';
		}
	}


	$tabla.='</tbody></table></div>';

	if($total>0 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Mostrando ventas <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}