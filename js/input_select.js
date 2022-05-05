 $(document).ready(function(){
    $("#select_product").on('change', function(){
        var id = $(this).val();
        

        $.ajax({
            url:"./php/agregar_producto.php",
            type:"POST",
            data:'producto=' + id,
            success:function(data){
                $("#probando").html(data);
            }
            
        });
    });
});