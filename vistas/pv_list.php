

<h2 class="subtitle">Productos de la venta:</h2>
    <?php 

       require_once dirname(__DIR__)."/php/main.php";
      
       

        # Eliminar categoria #
        if(isset($_GET['pv_id_del'])){
            require_once dirname(__DIR__)."/php/pv_eliminar.php";
            //require_once "./php/pv_eliminar.php";
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

        # Paginador categoria #
        require_once dirname(__DIR__)."/php/pv_lista.php";
        $obtener_total=conexion();
       $obtener_total=$obtener_total->query("SELECT SUM(pv_total) AS total FROM producto_vendido WHERE venta_codigo='$codigo'");
       $venta_total=$obtener_total->fetch();
          
        $total=$venta_total['total'];
        $_SESSION['venta_total']=$total;
        echo '<h3 class="subtitle">Importe total: '.$total.'</h3>';
       $obtener_total=null;
        
    ?>
