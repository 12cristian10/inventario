<?php
require_once "../php/main.php";

 if(isset($_POST['producto'])){
    
	$producto_id=$_POST['producto'];
    
	$productos=conexion();
	$productos=$productos->query("SELECT * FROM producto WHERE producto_id = $producto_id");
		
	if($productos->rowCount()==1){

		$productos=$productos->fetchAll();


		foreach($productos as $row){
			
			echo'
            <div class="column">
		        <div>
		    		<label>Codigo</label>
		    		<input class="input" type="text" name="codigo_p" id="codigo_p" value="'.$row['producto_codigo'].'" readonly>
		    	</div>
		    </div>

		   
		    <div class="column">
		    	<div class="control">
		    		<label>Precio</label>
		    		<input class="input" type="text" name="precio_p" id="precio_p" value="'.$row['producto_precio'].'" readonly>
		    	</div>
		    </div>

		    <div class="column">
		    	<div class="control">
		    		<label>Stock</label>
		    		<input class="input" type="text" name="stock_p" id="stock_p" value="'.$row['producto_stock'].'" readonly>
		    	</div>
		    </div>';
        
		if($row['producto_stock']==0){
			echo'<div class="column">
			        <div class="notification is-warning is-light has-text-centered">
			                <strong>¡PRODUCTO AGOTADO!</strong><br>
		            </div>
           		</div>
           	</div>';
		}else{

			echo'
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
		    		    <input class="input" type="number" name="unidades_p" id="unidades_p"  min="1" required>
    		    	</div>
    		    </div>
            </div>';

		}	
		
		 }
	}

	   $productos=null; 

}

?> 
