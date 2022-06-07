<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	$campos="producto.producto_id,producto.producto_codigo,producto.producto_nombre,producto.producto_peso,producto.producto_pmedida,producto.producto_volumen,producto.producto_vmedida,producto.producto_fecha,producto.producto_precio,producto.producto_stock,producto.producto_foto,producto.categoria_id,producto.usuario_id,categoria.categoria_id,categoria.categoria_nombre,usuario.usuario_id,usuario.usuario_nombre,usuario.usuario_apellido,proveedor.proveedor_id,proveedor.proveedor_nombre";

	if(isset($busqueda) && $busqueda!=""){
		$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM producto INNER JOIN categoria ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id INNER JOIN proveedor ON producto.proveedor_id=proveedor.proveedor_id WHERE producto.producto_codigo LIKE '%$busqueda%' OR producto.producto_nombre LIKE '%$busqueda%' ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";
	}elseif($categoria_id>0){
		$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM producto INNER JOIN categoria ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id INNER JOIN proveedor ON producto.proveedor_id=proveedor.proveedor_id WHERE producto.categoria_id='$categoria_id' ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";
	}else{
		$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM producto INNER JOIN categoria ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id INNER JOIN proveedor ON producto.proveedor_id=proveedor.proveedor_id ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";
	}

	$conexion=conexion();

	$datos = $conexion->query($consulta);

	$datos = $datos->fetchAll();

	$total = $conexion->query("SELECT FOUND_ROWS()");
	$total = (int) $total->fetchColumn();

	$Npaginas =ceil($total/$registros);
   
	
	$tabla.='
	<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth"  >
            <thead>
                <tr class="has-text-centered">
                	<th>#</th>
					<th>Imagen</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
					<th>Precio</th>
					<th>Stock</th>
					<th>Categoria</th>
					<th>Proveedor</th>
					<th>Autor de registo</th>
                    <th colspan="3">Opciones</th>
                </tr>
            </thead>
            <tbody>
	';
	
	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){
			$tabla.='
				<tr>
					<td class="is-vcentered">'.$contador.'</td>
					<td><p class="image is-64x64" class="column">';
					
					if(is_file("./img/producto/".$rows['producto_foto'])){
						$tabla.='<img src="./img/producto/'.$rows['producto_foto'].'">';
					}else{
						$tabla.='<img src="./img/producto.png">';
					}
			$tabla.='</p></td>
                    <td class="is-vcentered">'.$rows['producto_codigo'].'</td>
					<td class="is-vcentered">'.$rows['producto_nombre'].'</td>
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
				$tabla.='</ul></p></td><td class="is-vcentered">'.$rows['producto_precio'].'</td>
					<td class="is-vcentered">'.$rows['producto_stock'].'</td>
					<td class="is-vcentered">'.$rows['categoria_nombre'].'</td>
					<td class="is-vcentered">'.$rows['proveedor_nombre'].'</td>
					<td class="is-vcentered">'.$rows['usuario_nombre'].' '.$rows['usuario_apellido'].'</td>
                    <td class="is-vcentered">
					    <a href="index.php?vista=product_update&product_id_up='.$rows['producto_id'].'" class="button is-success is-rounded is-small">Actualizar</a>
					</td>
                    <td class="is-vcentered">
					    <a href="'.$url.$pagina.'&product_id_del='.$rows['producto_id'].'" class="button is-danger is-rounded is-small">Eliminar</a>
					</td> 
					<td class="is-vcentered">
					    <a href="index.php?vista=product_img&product_id_up='.$rows['producto_id'].'" class="button is-link is-rounded is-small">Imagen</a>
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
					<td colspan="13">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haga clic acá para recargar el listado
						</a>
					</td>
				</tr>
			';
		}else{
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="13">
						No hay registros en el sistema
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