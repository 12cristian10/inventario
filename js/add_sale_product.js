$(document).ready(function(){
    $('#addProduct').on("click",function(){

        var producto= $('#select_product').val();
        var unidades_p=$('#unidades_p').val();
        var datos= 'producto=' + producto + '&unidades_p=' +unidades_p;
        
    
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

   $('#guardarVenta').on("click",function(){
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
}); 


