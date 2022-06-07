<div class="container is-fluid mb-6">
	<h1 class="title">Productos</h1>
	<h2 class="subtitle">Nuevo producto</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>
	<form action="./php/producto_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Numero de factura</label>
				  	<input class="input" type="text" name="producto_codigo" pattern="[a-zA-Z0-9- ]{1,70}" maxlength="70" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="producto_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required >
				</div>
		  	</div>
			  <div class="column">
				<label>Proveedor</label><br>
		    	<div class="select">
				  	<select name="producto_proveedor" required>
				    	<option value="" selected disabled>Seleccione un proveedor</option>
				    	<?php
    						$proveedores=conexion();
    						$proveedores=$proveedores->query("SELECT * FROM proveedor");
    						if($proveedores->rowCount()>0){
    							$proveedores=$proveedores->fetchAll();
    							foreach($proveedores as $row){
    								echo '<option value="'.$row['proveedor_id'].'" >'.$row['proveedor_nombre'].'</option>';
				    			}
				   			}
				   			$categorias=null;
				    	?>
				  	</select>
				</div>
		  	</div>
		</div>

		<div class="columns">
			<div class="column">
				<label>Peso</label>
			    <div class="field has-addons">
                    <p class="control">
					    <input class="input" type="number" name="producto_peso" min="1">
                    </p>
                    <p class="control">
					    <span class="select" >
                            <select name="producto_pu">
                              <option value="Kg">Kg</option>
                              <option value="g">g</option>
                              <option value="Lb">Lb</option>
                            </select>
                        </span>
                    </p>
				</div>	
            </div>
			<div class="column">
				<label>Volumen</label>
			    <div class="field has-addons">
                    <p class="control">
					    <input class="input" type="number" name="producto_volumen" min="1">
                    </p>
                    <p class="control">
					    <span class="select">
                            <select name="producto_vu">
                              <option selected value="Lt">Lt</option>
                              <option value="ml">ml</option>
                              <option value="m3">m3</option>
                            </select>
                        </span>
                    </p>
				</div>
            </div>

			<div class="column">
		    	<div class="control">
					<label>Fecha de caducidad</label>
				  	<input class="input" type="date" name="producto_fecha">
				</div>
		  	</div>
		    	
		</div>


		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Precio</label>
				  	<input class="input" type="number" name="producto_precio" min="1" required>
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Stock</label>
				  	<input class="input" type="number" name="producto_stock" min="1" required>
				</div>
		  	</div>
		  	<div class="column">
				<label>Categoría</label><br>
		    	<div class="select">
				  	<select name="producto_categoria" required>
				    	<option value="" selected disabled >Seleccione una categoria</option>
				    	<?php
    						$categorias=conexion();
    						$categorias=$categorias->query("SELECT * FROM categoria");
    						if($categorias->rowCount()>0){
    							$categorias=$categorias->fetchAll();
    							foreach($categorias as $row){
    								echo '<option value="'.$row['categoria_id'].'" >'.$row['categoria_nombre'].'</option>';
				    			}
				   			}
				   			$categorias=null;
				    	?>
				  	</select>
				</div>
		  	</div>
		</div>
		<div class="columns">
			<div class="column">
				<label>Foto o imagen del producto</label><br>
				<div class="file has-name" id="file-img">
				  	<label class="file-label">
				    	<input class="file-input" type="file" name="producto_foto" accept=".jpg, .png, .jpeg" >
				    	<span class="file-cta">
				      		<span class="file-label">Imagen</span>
				    	</span>
				    	<span class="file-name">JPG, JPEG, PNG. (MAX 3MB)</span>
				  	</label>
				</div>
			</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>