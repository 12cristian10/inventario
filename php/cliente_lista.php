<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	if(isset($busqueda) && $busqueda!=""){
		$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM cliente WHERE cliente_nombre LIKE '%$busqueda%' OR cliente_apellido LIKE '%$busqueda%' OR cliente_documento LIKE '%$busqueda%' OR cliente_td LIKE '%$busqueda%' ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";
	}else{
		$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM cliente ORDER BY cliente_nombre ASC LIMIT $inicio,$registros";
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
                    <th>Tipo de documento</th>
                    <th>Numero de documento</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Direccion</th>
                    <th>Ciudad</th>
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
                    <td>';
                    switch($rows['cliente_td']){
                        case"CC":
                            $tabla.='Cedula de ciudadania';
                        break;
                        case"CE":
                            $tabla.='Cedula de extrangeria';
                        break;
                        case"DE":
                            $tabla.='Documento de extranjeria';
                        break;
                        case"PAS":
                            $tabla.='Pasaporte';
                        break;
                        case"NIT":
                            $tabla.='NIT';
                        break;
                    }
             $tabla.='</td>
                    <td>'.$rows['cliente_documento'].'</td>
                    <td>'.$rows['cliente_nombre'].'</td>
                    <td>'.$rows['cliente_apellido'].'</td>
                    <td>'.$rows['cliente_telefono'].'</td>
                    <td>'.$rows['cliente_email'].'</td>
                    <td>'.$rows['cliente_direccion'].'</td>
                    <td>'.$rows['cliente_ciudad'].'</td>
                    <td>
                        <a href="index.php?vista=client_update&client_id_up='.$rows['cliente_id'].'" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    <td>
                        <a href="'.$url.$pagina.'&client_id_del='.$rows['cliente_id'].'" class="button is-danger is-rounded is-small">Eliminar</a>
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
					<td colspan="7">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haga clic acá para recargar el listado
						</a>
					</td>
				</tr>
			';
		}else{
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="11">
						No hay registros en el sistema
					</td>
				</tr>
			';
		}
	}


	$tabla.='</tbody></table></div>';

	if($total>0 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Mostrando clientes <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}