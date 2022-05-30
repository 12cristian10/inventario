
document.addEventListener('DOMContentLoaded', () => {
    // Functions to open and close a modal
    function openModal($el) {
      $el.classList.add('is-active');
    }
  
    function closeModal($el) {
      $el.classList.remove('is-active');
    }
  
    function closeAllModals() {
      (document.querySelectorAll('.modal') || []).forEach(($modal) => {
        closeModal($modal);
      });
    }
   // Add a click event on buttons to open a specific modal
  (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
    const modal = $trigger.dataset.target;
    const $target = document.getElementById(modal);

    $trigger.addEventListener('click', () => {
      openModal($target);
    });
  });
   
 
  // Add a click event on various child elements to close the parent modal
  (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete') || []).forEach(($close) => {
    const $target = $close.closest('.modal');
  
    $close.addEventListener('click', () => {
      closeModal($target);
    });
  }); 

  (document.querySelectorAll('#cancelar') || []).forEach(($close) => {
    const $target = $close.closest('.modal');
  
    $close.addEventListener('click', () => { 
      location.reload();
      closeModal($target);
    });
  });

  (document.querySelectorAll('#addProduct') || []).forEach(($close) => {
    const $target = $close.closest('.modal');
    
    $close.addEventListener('click', () => { 

    
  if($('#select_product').val() == null || $('#unidades_p').val()==""){
        console.log("no se envian datos");
      }else{  
        $("#addNewProduct").load("./vistas/add_product.php");
        closeModal($target);
      } 

    });
  });

  // Add a keyboard event to close all modals
  document.addEventListener('keydown', (event) => {
    const e = event || window.event;

    if (e.keyCode === 27) { // Escape key
      closeAllModals();
    }
  });

 }); 
