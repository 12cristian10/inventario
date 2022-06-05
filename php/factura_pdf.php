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

 
$celdas="venta.venta_id,venta.venta_codigo,venta.venta_fecha,venta.venta_stock,venta.venta_total,venta.venta_factura,cliente.cliente_id,cliente.cliente_nombre,cliente.cliente_apellido,cliente.cliente_documento,cliente.cliente_telefono,cliente.cliente_email,cliente.cliente_direccion,venta.usuario_id,usuario.usuario_nombre,usuario.usuario_apellido";

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
    <body>

	<h1 class="title">Factura de venta</h1>
	
    <div class="columns">
        <div class="column">
            <p class="text is-size-5"><strong>Nro. de factura:</strong>  <?php echo $infoVenta['venta_factura']; ?></p>
		</div>
        <div class="column">
            <p class="text is-size-5"><strong>Codigo de venta:</strong>  <?php echo $infoVenta['venta_codigo']; ?></p>
		</div>
	</div>
    <div class="columns">
        <div class="column">
            <p class="text is-size-5"><strong>Fecha de emision:</strong>  <?php echo $infoVenta['venta_fecha']; ?></p>
	    </div>
    </div>
    <div class="columns">
        <div class="column">
            <p class="text is-size-5"><strong>Numero de documento:</strong>  <?php echo $infoVenta['cliente_documento']; ?></p>
		</div>

        <div class="column">
            <p class="text is-size-5"><strong>Cliente:</strong>  <?php echo $infoVenta['cliente_nombre']." ".$infoVenta['cliente_apellido']; ?></p>
	    </div>
    </div>

    <div class="columns">
         <div class="column">
            <p class="text is-size-5"><strong>Productos de la venta:</strong></p>
            </div>   
	</div>
    <div class="table">
        <?php
         
       require_once dirname(__DIR__)."/php/factura_lista.php";

       echo '
            <p class="text has-text-right is-size-5"><strong>Importe total:</strong>  '.$infoVenta['venta_total'].'<br></p> 
             
             <p class="text has-text-right is-size-5"><strong>Nro. de productos:</strong>  '.$infoVenta['venta_stock'].'</p>
            
            ';

        ?>
    </div> 

		  	
	<div class="columns">
        <p class="text is-size-5"><strong>Telefono:</strong>  <?php echo $infoVenta['cliente_telefono']; ?></p>
	</div>
    <div class="columns">
        <p class="text is-size-5"><strong>Correo electronico:</strong>   <?php echo $infoVenta['cliente_email']; ?></p>
	</div>
	<div class="columns">
        <p class="text is-size-5"><strong>Direccion:</strong>  <?php echo $infoVenta['cliente_direccion']; ?> </p>
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
$dompdf->setOptions($options);

$dompdf -> loadHTML($html);
$dompdf -> set_paper("A4", "landscape");
$dompdf ->setPaper('letter');
$dompdf -> render();
$dompdf -> stream($name, array("Attachment" => false)); 
?>

