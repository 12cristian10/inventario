<?php
$productos=conexion();
$productos=$productos->query("SELECT * FROM producto");

if($productos->rowCount()>0){
?>
<div class="container pt-4">
<h2 class="subtitle">Agregar productos a la venta:</h2>

    <div class="form-rest mb-4 mt-4"></div>

	<form action="./php/pv_guardar.php" method="POST" class="FormularioVentas" autocomplete="off">

			
	    <div class="columns">
			
			<div class="colums">
				<div class="column">
				    <label>Nombre</label>
		    	    <div class="select">
				      	<select name="producto" id="select_product" required>
				        	<option value="" selected disabled>Seleccione una opción</option>
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
			</div>

            <div class="columns is-vcentered" id="datos_producto">
			   <div class="column">
	    	    	<div class="control">
	    				<label>Codigo</label>
	    			  	<input class="input" type="text" name="codigo_p" id="codigo_p" disabled>
	    			</div>
	    	  	</div>
	    	  	<div class="column">
	    	    	<div class="control">
	    				<label>Peso</label>
	    			  	<input class="input" type="text" name="peso_p" id="peso_p" disabled>
	    			</div>
	    	  	</div>
	    		<div class="column">
	    	    	<div class="control">
	    				<label>Precio</label>
	    			  	<input class="input" type="text" name="precio_p" id="precio_p" disabled>
	    			</div>
	    	  	</div>
	    		  <div class="column">
	    	    	<div class="control">
	    				<label>Stock</label>
	    			  	<input class="input" type="text" name="stock_p" id="stock_p" disabled>
	    			</div>
	    	  	</div>
	    		  <div class="column">
	    	    	<div class="control">
	    				<labe>Cantidad requerida</label>
	    			  	<input class="input" type="text" name="unidades_p" id="unidades_p" pattern="[0-9]{1,25}" maxlength="25"  required>
	    			</div>
	    	  	</div>
				<div class="column pt-5">
				
				 <button type="submit" id="add_product" class="button is-info is-rounded">Agregar</button>
					 
			    </div>  
			</div>
	  
	    </div>
            
	</form>

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