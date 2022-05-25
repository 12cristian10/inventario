<?php
require "../php/main.php";

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
		    		<label>Peso</label>
		    		<input class="input" type="text" name="peso_p" id="peso_p" value="'.$row['producto_peso'].'" readonly>
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
		    </div>

		    <div class="column">
		    	<div class="control">
		    		<labe>Cantidad requerida</label>
		    		<input class="input" type="number" name="unidades_p" id="unidades_p"  min="1" required>
		    	</div>
		    </div>
        </div>        
	';
		 }
	}

	   $productos=null; 

}

?> 
