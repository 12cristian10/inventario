

<h2 class="subtitle">Productos de la venta:</h2>
    <?php 

       require_once dirname(__DIR__)."/php/main.php";
      
       

        # Eliminar producto vendido #

        if(isset($_GET['pv_id_del'])){
            require_once dirname(__DIR__)."/php/pv_eliminar.php";
        }

        if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }

        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=sale_new&page="; /* <== */
        $registros=15;
        $busqueda="";

        # Paginador de producto vendido #
        require_once dirname(__DIR__)."/php/pv_lista.php";
        $obtener_total=conexion();
        $obtener_total=$obtener_total->query("SELECT SUM(pv_stock) AS numproductos,SUM(pv_total) AS total FROM producto_vendido WHERE venta_codigo='$codigo'");
        $venta_total=$obtener_total->fetch();
           
        $total=$venta_total['total'];
        
        $numProductos=$venta_total['numproductos'];
 
        $_SESSION['venta_total']=$total;
        $_SESSION['venta_stock']=$numProductos;
        echo '<h4 class="title is-4">Importe total: '.$total.'</h4>
              <h4 class="title is-4">Nro. de productos: '.$numProductos.'</h4>
              <input type="hidden" id="cantidadPv" value="'.$numProductos.'">';

       $obtener_total=null;
        
    ?>
