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
		    		<input class="input" type="text" name="codigo_p" value="'.$row['producto_codigo'].'" disabled>
		    	</div>
		    </div>

		    <div class="column">
		    	<div class="control">
		    		<label>Peso</label>
		    		<input class="input" type="text" name="peso_p" value="'.$row['producto_peso'].'" disabled>
		    	</div>
		    </div>

		    <div class="column">
		    	<div class="control">
		    		<label>Precio</label>
		    		<input class="input" type="text" name="precio_p" value="'.$row['producto_precio'].'" disabled>
		    	</div>
		    </div>

		    <div class="column">
		    	<div class="control">
		    		<label>Stock</label>
		    		<input class="input" type="text" name="stock_p" value="'.$row['producto_stock'].'" disabled>
		    	</div>
		    </div>

		    <div class="column">
		    	<div class="control">
		    		<labe>Cantidad requerida</label>
		    		<input class="input" type="text" name="unidades_p" pattern="[0-9]{1,25}" maxlength="25"  required>
		    	</div>
		    </div>

		    <div class="column pt-5">
			    <button type="submit" class="button is-info is-rounded">Agregar</button>
            </div>
        </div>        
	';
		 }
	}

	   $productos=null; 

}else{
	echo'<h2> no hay </h2>';
}



?> 
