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
?>

<div id="areaImpresion" class="container is-fluid mb-4">
	<h1 class="title">Factura de venta</h1>

    <div class="container pb-5 pt-5">
   
	

    <div class="column py-4">
            <p class="text is-size-5"><strong>Nro. de factura:</strong>  <?php echo $infoVenta['venta_factura']; ?></p>
            <p class="text is-size-5"><strong>Codigo de venta:</strong>  <?php echo $infoVenta['venta_codigo']; ?></p>
            <p class="text is-size-5"><strong>Fecha de emision:</strong>  <?php echo $infoVenta['venta_fecha']; ?></p>
            <p class="text is-size-5"><strong>Vendedor:</strong>  <?php echo $infoVenta['usuario_nombre'].' '.$infoVenta['usuario_apellido']; ?><br><br></p>  
        </div> 
        <div class="colum mx-6">
        <table class="table is-bordered is-fullwidth">
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

    <div class="columns">
         <div class="column">
            <p class="text is-size-5"><strong>Productos de la venta:</strong></p>
            </div>   
	</div>
    <div class="table">
        <?php
         
       # Paginador de producto vendido #
       require_once dirname(__DIR__)."/php/factura_lista.php";

       echo '
            <p class="text has-text-right is-size-5"><strong>Importe total:</strong>  '.$infoVenta['venta_total'].'<br></p> 
             
             <p class="text has-text-right is-size-5"><strong>Nro. de productos:</strong>  '.$infoVenta['venta_stock'].'</p>
            
            ';

        ?>
    </div> 

</div>
<div class="container pb-5 pt-5">
<div class="field is-grouped">
        <p class="control"><a href="index.php?vista=home" class="button is-primary is-rounded">Regresar al menu</a></p>
        <p class="control"> <a href="./php/factura_pdf.php?sale_cod=<?php echo $infoVenta['venta_codigo'];?>" class="button is-link is-rounded">Guardar como PDF</a></p>
        <p class="control"><button id="imprimirFactura" class="button is-info is-rounded">Imprimir</button></p>
    </div>
</div>

</div>


