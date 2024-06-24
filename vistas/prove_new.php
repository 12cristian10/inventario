<div class="container is-fluid mb-6">
	<h1 class="title">proveedor</h1>
	<h2 class="subtitle">Nuevo proveedor</h2>
</div>
<div class="container pb-6 pt-6">

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/proveedor_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="columns">
            <div class="column">
		    	<div class="control">
					<label>RUT</label><br>
		    	    <div class="select">
				  	    <select name="proveedor_td" required>
				        	<option value="" selected disabled>Seleccione una opción</option>
                            <option value="CC" >Cedula de ciudadania</option>
                            <option value="NIT" >NIT</option>
				  	    </select>
				    </div>
				</div>
		  	</div>
            <div class="column">
		    	<div class="control">
					<label>Numero de documento</label>
				  	<input class="input" type="text" name="proveedor_documento"  pattern="[0-9]{7,20}" maxlength="20" required >
				</div>
		  	</div>
		</div>
        <div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre de la empresa</label>
				  	<input class="input" type="text" name="proveedor_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Telefono</label>
				  	<input class="input" type="tel" name="proveedor_telefono" pattern="[0-9]{10}" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Email</label>
				  	<input class="input" type="email" name="proveedor_email" required>
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Direccion</label>
				  	<input class="input" type="text" name="proveedor_direccion" placeholder="Barrio, calle ** #**-**" maxlength="100" required>
				</div>
		  	</div>
            <div class="column">
		    	<div class="control">
					<label>Ciudad</label>
				  	<input class="input" type="text" name="proveedor_ciudad"  maxlength="100" required >
				</div>
		    </div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>