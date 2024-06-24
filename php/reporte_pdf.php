<?php
 require_once dirname(__DIR__)."/php/main.php";
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUFF KEY</title>
    <link rel="stylesheet" href="http://localhost/inventario/css/bulma.min.css">
    <link rel="stylesheet" href="http://localhost/inventario/css/estilos.css">
</head>
<body>
<div class="container is-fluid mb-6">
	<h1 class="title">Reportes</h1>
	<h2 class="subtitle">Inventario</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
    	
        require_once dirname(__DIR__)."/php/reporte_inventario.php";
        date_default_timezone_set("America/Bogota");
        $fecha=date("d-m-Y");


       $tabla='';
       $tabla2='';
    ?>
    <nav class="level is-mobile">
        <div class="level-item has-text-centered">
          <div>
            <p class="heading is-size-4">Usuarios</p>
            <p class="title"><?php echo $cont_usuario;?></p>
          </div>
        </div>
        <div class="level-item has-text-centered">
          <div>
            <p class="heading is-size-4">Proveedores</p>
            <p class="title"><?php echo $cont_proveedor;?></p>
          </div>
        </div>
        <div class="level-item has-text-centered">
          <div>
            <p class="heading is-size-4">Categorias</p>
            <p class="title"><?php echo $cont_categoria;?></p>
          </div>
        </div>
        <div class="level-item has-text-centered">
          <div>
            <p class="heading is-size-4">Productos</p>
            <p class="title"><?php echo $cont_producto; ?></p>
          </div>
        </div>
    </nav>
    <br>
    <br>
    <div class="columns mb-4 pt-4">
        <div class="column">
            <div class="card">
                 <header class="card-header">
                    <p class="card-header-title">
                      Reporte <?php echo $fecha; ?>
                    </p>
                  </header>
                  <div class="card-content">
                    <div class="content">
                    <div class="table-container">
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth"  >
                            <thead>
                <tr class="has-text-centered">
                	<th>#</th>
                    <th>Codigo</th>
                    <th>Nombre de producto</th>
					<th>Stock disponible</th>
                    <th>Precio de compra</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $contador=1;
                foreach($datos as $rows){

                    $tabla.='
                        <tr>
                            <td class="is-vcentered">'.$contador.'</td>
                            <td class="is-vcentered">'.$rows['producto_codigo'].'</td>
                            <td class="is-vcentered">'.$rows['producto_nombre'].'</td>
                            <td class="is-vcentered">'.$rows['producto_stock'].'</td>
                            <td class="is-vcentered">'.$rows['producto_precio'].'</td>
                            
                        </tr>
                    ';
                    $contador++;
                   
                }
                echo $tabla;
                ?>  
                </tbody>
</table>
</div>
                     
                    </div>
                  </div>
                  
            </div>
        </div>
        <div class="column">
        <div class="card">
  <header class="card-header">
    <p class="card-header-title">
      Control de ingreso
    </p>
  </header>
  <div class="card-content">
    <div class="content">
    <div class="table-container">
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth"  >
                            <thead>
                <tr class="has-text-centered">
                	<th>#</th>
                    <th>Codigo</th>
                    <th>Nombre de producto</th>
                    <th>Fecha de ingreso</th>
                    <th>Stock inicial</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $contador=1;
                foreach($reporte as $rows){

                    $tabla2.='
                        <tr>
                            <td class="is-vcentered">'.$contador.'</td>
                            <td class="is-vcentered">'.$rows['producto_codigo'].'</td>
                            <td class="is-vcentered">'.$rows['producto_nombre'].'</td>
                            <td class="is-vcentered">'.$rows['fecha_ingreso'].'</td>
                            <td class="is-vcentered">'.$rows['cantidad_ingresada'].'</td>
                             
                        </tr>
                    ';
                    $contador++;
                   
                }
                echo $tabla2;
                ?>  
                </tbody>
</table>
</div>
    </div>
  </div>
 
</div>
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

$name="Reporte_".$fecha.".pdf";

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->set_option('dpi', 120);
$dompdf->setOptions($options);

$dompdf -> loadHTML($html);
$dompdf -> set_paper("letter", "portrait");
$dompdf -> render();
$dompdf -> stream($name, array("Attachment" => true)); 
?>