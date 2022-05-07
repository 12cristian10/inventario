const form_ajax=document.querySelectorAll(".FormularioVentas");

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
            console.log("b");
            $("#tabla").load("./vistas/pv_list.php");
        });
    }

}

form_ajax.forEach(formularios => {
    formularios.addEventListener("click",send_form_ajax);
});