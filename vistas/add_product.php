
<!-- modal para agregar productos -->

<div id="addNewProduct" class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Agregar nuevo producto</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
	<div id="respuesta" class="form-rest mb-4 mt-4"></div>

        	<div class="column">
			     <label>Nombre</label>
			</div>
		     
        	<div class="column">
        		
        		<div id="selector" class="select">
        			  <select name="producto" id="select_product" required>
        				<option value="" selected disabled>Seleccione un producto</option>
        				<?php
        				   
        					$productos=conexion();

        					$productos=$productos->query("SELECT * FROM producto");
        					if($productos->rowCount()>0){
        						$productos=$productos->fetchAll();
        						foreach($productos as $row){
        							echo '<option value="'.$row['producto_id'].'" >'.$row['producto_nombre'].'</option>';
        						}
        					   }
        					   $productos=null;
        				?>
        			  </select>
        		</div>
        	 </div>
        	
        
        		<div id="datos_producto">
        		   	
        			<div class="column">
        			    <div class="control">
        					<label>Codigo</label>
        					  <input class="input" type="text" name="codigo_p" id="codigo_p" readonly>
        				</div>
        			</div>

        			<div class="column">
        				<div class="control">
        					<label>Precio</label>
        					  <input class="input" type="text" name="precio_p" id="precio_p" readonly>
        				</div>
        			</div>
        			<div class="column">
        				<div class="control">
        					<label>Stock</label>
        					  <input class="input" type="text" name="stock_p" id="stock_p" readonly>
        				</div>
        			</div>
                    
					<div class="column">
					        <labe>Margen de ganancias</label>
					        <div class="field has-addons">
					          
					            <p class="control">
								
        					  <input class="input" type="number" name="utilidades" id="utilidades" min="1" max="100" required>
                                 </p>
                                  <p class="control">
                                    <a class="button is-static">
                                      %
                                    </a>
                                  </p>
                                
        			
        			    </div>
        			</div>
					

        			<div class="column">
        				<div class="control">
        					<labe>Cantidad requerida</label>
        					  <input class="input" type="number" name="unidades_p" id="unidades_p" min="1" required>
        				</div>
        			</div>
        			
        		</div>
          
        	
        		
       
    </section>
    <footer class="modal-card-foot">
      <button id="addProduct"class="button is-success" type="button" >Agregar a la venta</button>

	<button id="cancelar" class="button">Cancelar</button>
    </footer>
  </div>
</div>
