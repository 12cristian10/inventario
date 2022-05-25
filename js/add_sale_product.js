const form_ajax=document.querySelector("#FormularioProductos");
function send_form_ajax(e){
    e.preventDefault();

    let enviar=confirm("Quieres enviar el formulario");

    if(enviar==true){

        let data= new FormData(this);
        let method=this.getAttribute("method");
        let action=this.getAttribute("action");

        let encabezados= new Headers();

        let config={
            method: method,
            headers: encabezados,
            mode: 'cors',
            cache: 'no-cache',
            body: data
        };

        fetch(action,config)
        .then(respuesta => respuesta.text())
        .then(respuesta =>{ 
            let contenedor=document.querySelector(".form-rest");
            contenedor.innerHTML = respuesta;
            $("#tabla").load("./vistas/pv_list.php");
        });
    }

}

//form_ajax.addEventListener("submit",send_form_ajax); 
 
/*const Enviar = document.querySelectorAll('.add_product');
$(document).ready(function(){
    $('.add_product').click(function(){
        alert(1);
        
        alert(1); 
        var datos=$('#FormularioProductos').serialize();
        console.log(datos);
        
    });
});

$(document).ready(function(){
    $('#guardar').click(function(){
        var datos=$('#FormularioVentas').serialize();
        $.ajax({
            type:"POST",
            url:"./php/venta_guardar.php",
            data:datos,
            success:function(data){
                $(".form-rest").html(data);
            }
        });

    
    });
});*/

