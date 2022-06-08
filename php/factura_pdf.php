<?php 
    require_once dirname(__DIR__)."/inc/session_start.php";
    require_once dirname(__DIR__)."/php/main.php";
      

    if(isset($_GET['sale_cod']) && !empty($_GET['sale_cod'])){
        $codp=$_GET['sale_cod'];
        
    }else{
      if(isset($_SESSION['venta_codigo'])){
        $codp=$_SESSION['venta_codigo'];
      }

    }

 
$celdas="venta.venta_id,venta.venta_codigo,venta.venta_fecha,venta.venta_stock,venta.venta_total,venta.venta_factura,cliente.cliente_id,cliente.cliente_nombre,cliente.cliente_apellido,cliente.cliente_documento,cliente.cliente_telefono,cliente.cliente_email,cliente.cliente_direccion,cliente.cliente_ciudad,venta.usuario_id,usuario.usuario_nombre,usuario.usuario_apellido";

        $consulta="SELECT $celdas FROM venta INNER JOIN cliente ON venta.cliente_id=cliente.cliente_id INNER JOIN usuario ON venta.usuario_id=usuario.usuario_id WHERE venta.venta_codigo='$codp'";

        $conexion=conexion();

	    $infoVenta = $conexion->query($consulta);


        $infoVenta = $infoVenta->fetch();

      ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BUFF KEY</title>
    <link rel="stylesheet" href="http://localhost/inventario/css/bulma.min.css">
    <link rel="stylesheet" href="http://localhost/inventario/css/estilos.css">
</head>
<body class="margenespdf">
    <div class="container is-fluid py-5" id="imprimible"></div>
        <div class="container is-fluid mb-4 pr-4 mx-4">

            <div class="container pb-6 py-4"> 
                <table class="table is-fullwidth">
                    <tr>
                        <td><h2 class="has-text-weight-bold is-size-2">Factura de venta</h2></td>
                        <td class=""><img src="http://localhost/inventario/img/buff_logo.png" width="220" height="110"></td>
                    </tr>
                </table>


                <div class="column py-4">
                    <p class="text is-size-5"><strong>Nro. de factura:</strong>  <?php echo $infoVenta['venta_factura']; ?></p>
                    <p class="text is-size-5"><strong>Codigo de venta:</strong>  <?php echo $infoVenta['venta_codigo']; ?></p>
                    <p class="text is-size-5"><strong>Fecha de emision:</strong>  <?php echo $infoVenta['venta_fecha']; ?></p>
                    <p class="text is-size-5"><strong>Vendedor:</strong>  <?php echo $infoVenta['usuario_nombre'].' '.$infoVenta['usuario_apellido']; ?><br><br></p>  
                </div> 
                <div class="column">
                    <table class="table is-bordered ">
                        <tr>
                            <td colspan="6"> <p class="has-text-centered"><strong>Datos del cliente</strong></p></td>
                        </tr>
                        <tr>
                            <td><strong>Cliente:</strong></td><td colspan="2"><?php echo $infoVenta['cliente_nombre']." ".$infoVenta['cliente_apellido']; ?></td>
                            <td><strong>Nro. de documento:</strong></td><td colspan="2"><?php echo $infoVenta['cliente_documento']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Telefono:</strong></td><td colspan="2"><?php echo $infoVenta['cliente_telefono']; ?></td>
                            <td><strong>E-mail:</strong></td><td colspan="2"><?php echo $infoVenta['cliente_email']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Ciudad:</strong></td><td colspan="2"><?php echo $infoVenta['cliente_ciudad']; ?></td>
                            <td><strong>Direccion:</strong></td><td colspan="2"><?php echo $infoVenta['cliente_direccion']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="column pt-3">
                    <p class="text is-size-5"><br><br><strong>Productos de la venta:</strong></p>
                </div>  
                <div class="columms mx-4 pr-6">
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
                             <table class="table is-bordered is-striped is-narrow is-hoverable">
                                 <thead>
                                    <tr class="has-text-centered">
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Codigo</th>
                                        <th>Descripcion</th>
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
                             
                     
                
                         $tabla.='</tbody></table>
                         
                         
            
                         </div>';
                     
                         
                     
                         $conexion=null;
                         echo $tabla;
                
                        echo '
                            <div class="column mr-6">
                            
                            <p class="has-text-right is-size-5 pr-6"><strong>Importe total:</strong>  '.$infoVenta['venta_total'].'<br></p> 
                             
                             <p class="has-text-right is-size-5 pr-6"><strong>Nro. de productos:</strong>  '.$infoVenta['venta_stock'].'</p>
                        
	                        </div>';

                        ?>
                </div> 
            </div> 
        </div>	
    </body>
</html>

<?php 


$html=ob_get_clean();


require_once dirname(__DIR__).'/inc/lib/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$name="Factura_Nro.".$infoVenta['venta_factura'].".pdf";

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->set_option('dpi', 120);
$dompdf->setOptions($options);

$dompdf -> loadHTML($html);
$dompdf -> set_paper("letter", "portrait");
$dompdf -> render();
$dompdf -> stream($name, array("Attachment" => true)); 
?>

