<?php 

$productos=conexion();
$productos=$productos->query("SELECT * FROM producto");

if($productos->rowCount()>0){
?>
<div class="container pt-4">
<h2 class="subtitle">Productos de la venta:</h2>

	<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                	<th>#</th>
                    <th>Nombre</th>
                    <th>Codigo</th>
                    <th>Peso</th>
                    <th>Precio unitario</th>
                    <th>Cantidad vendida</th>
                    <th>Subtotal</th>
                    <th colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody id="infoProducto">
			</tbody>
		</table>
		<button type="button" id="agregarpv" class="js-modal-trigger button is-info is-rounded" data-target="addNewProduct">Agregar producto</button>
	</div>
    
</div> 

<div id="addNewProduct" class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Agregar nuevo producto</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
	    <div class="form-rest mb-4 mt-4"></div>
        <form action="" method="POST" id="FormularioProductos" autocomplete="off">
        
        		
        
        	<div class="column">
			     <label>Nombre</label>
			</div>
		     
        	<div class="column">
        		
        		<div class="select">
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
						      <label>Peso</label>
        					  <input class="input" type="text" name="peso_p" id="peso_p" readonly>
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
        				<div class="control">
        					<labe>Cantidad requerida</label>
        					  <input class="input" type="number" name="unidades_p" id="unidades_p" min="1" required>
        				</div>
        			</div>
        			
        		</div>
          
        	
        		
        </form> 
    </section>
    <footer class="modal-card-foot">
      <button id="addProduct"class="button is-success">Agregar a la venta</button>
      <button class="button">Cancelar</button>
    </footer>
  </div>
</div>
<?php
}
else{
?>
<div class="container pt-4">
  
  <div class="column pb-6 has-text-centered">
	  <h2 class="subtitle">NO EXISTEN PRODUCTOS REGISTRADOS EN EL SISTEMA</h2>
  </div>

    <div class="columns">
				
		<div class="column">
		    <a href="index.php?vista=product_new" class="button is-success is-rounded">Agregar producto al sistema</a>
		</div>
		<div class="column is-offset-8">
		    <a href="index.php?vista=home" class="button is-link is-rounded">Regresar al menu</a>
		</div>
		
	  
	</div>


</div>

<?php
}
?>