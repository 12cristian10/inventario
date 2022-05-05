
<div class="pt-6">
<h2 class="subtitle">Productos añadidos a la venta: </h2>  
</div>

<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";

        # Eliminar categoria #
        if(isset($_GET['pv_id_del'])){
            require_once "./php/pv_eliminar.php";
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
        $url="index.php?vista=pv_list&page="; /* <== */
        $registros=15;
        $busqueda="";

        # Paginador categoria #
        require_once "./php/pv_lista.php";
    ?>
</div>