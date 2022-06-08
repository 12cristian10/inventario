$(document).ready(function(){
    $('#addProduct').on("click",function(){

        var producto= $('#select_product').val();
        var unidades_p=$('#unidades_p').val();
        var utilidades=$('#utilidades').val();
        console.log(utilidades);
        var datos= 'producto=' + producto + '&unidades_p=' + unidades_p + '&utilidades=' + utilidades;
        
    
        $.ajax({
            type:"POST",
            url:"./php/pv_guardar.php",
            data:datos,
            success:function(resp){
                $("#respuesta").html(resp);
                $("#tabla").load("./vistas/pv_list.php");
                
    
            }
        });
       
        
    }); 

   $('#confirmarVenta').on("click",function(){
        var venta_codigo=$('#venta_codigo').val();
        var venta_fecha=$('#venta_fecha').val();
        var cliente= $('#select_client').val();
        
        var datos= 'venta_codigo=' + venta_codigo + '&venta_fecha=' +venta_fecha  + '&cliente=' +cliente;
        
        $.ajax({
            type:"POST",
            url:"./php/venta_guardar.php",
            data:datos,
            success:function(resp){
                $("#respuesta2").html(resp);
            }
        });
       
        
    });

    $('#mostrarVenta').on("click",function(){
        var mostrar="si";
        var venta_codigo=$('#venta_codigo').val();
        var venta_fecha=$('#venta_fecha').val();
        var cliente= $('#select_client').val();
        
        var datos= 'venta_codigo=' + venta_codigo + '&venta_fecha=' +venta_fecha  + '&cliente=' +cliente + '&mostrarVenta=' +mostrar;
        
        $.ajax({
            type:"POST",
            url:"./php/venta_guardar.php",
            data:datos,
            success:function(resp){
                $("#respuesta2").html(resp);
                if(!($('#select_client').val() == null || $('#cantidadPv').val()=="")){
                    location="index.php?vista=bill_sale";
                } 
                
                
            }
        });
       
        
    });

    $('#descartarVenta').on("click",function(){
        var descartar=true;
        var datos='descartarVenta='+descartar;
    
        
        $.ajax({
            type:"POST",
            url:"./php/venta_descartar.php",
            data:datos,
            success:function(resp){
                console.log(resp);

            }
        });
       
        
    });
}); 


