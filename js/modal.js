
document.addEventListener('DOMContentLoaded', () => {
    // Functions to open and close a modal
    function openModal($el) {
      $el.classList.add('is-active');
    }
  
    function closeModal($el) {
      $el.classList.remove('is-active');
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

  if(!($('#select_product').val() == null || $('#unidades_p').val()<=0 || $('#unidades_p').val() > parseInt($('#stock_p').val(),10) || $('#utilidades').val()=="" || parseInt($('#utilidades').val(),10)>100 || parseInt($('#utilidades').val(),10)<=0)){
      closeModal($target);
    }
   

    });
  });

 (document.querySelectorAll('#confirmarVenta') || []).forEach(($close) => {
    const $target = $close.closest('.modal');

    $close.addEventListener('click', () => { 
      closeModal($target);
    });
  }); 

  (document.querySelectorAll('#mostrarVenta') || []).forEach(($close) => {
    const $target = $close.closest('.modal');
    
    $close.addEventListener('click', () => { 
     
      closeModal($target);
      
  
    });
    
  });

  (document.querySelectorAll('#descartarVenta') || []).forEach(($close) => {
    const $target = $close.closest('.modal');
  
    $close.addEventListener('click', () => { 
      
      closeModal($target);
      location.reload();

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
