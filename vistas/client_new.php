<div class="container is-fluid mb-6">
	<h1 class="title">Clientes</h1>
	<h2 class="subtitle">Nuevo cliente</h2>
</div>
<div class="container pb-6 pt-6">

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/cliente_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="columns">
            <div class="column">
		    	<div class="control">
					<label>Tipo de documento</label><br>
		    	    <div class="select">
				  	    <select name="cliente_td" required>
				        	<option value="" selected disabled>Seleccione una opción</option>
                            <option value="CC" >Cedula de ciudadania</option>
                            <option value="CE" >Cedula de extrangeria</option>
                            <option value="DE" >Documento extranjero</option>
                            <option value="PAS" >Pasaporte</option>
                            <option value="NIT" >NIT</option>
				  	    </select>
				    </div>
				</div>
		  	</div>
            <div class="column">
		    	<div class="control">
					<label>Numero de documento</label>
				  	<input class="input" type="text" name="cliente_documento"  pattern="[0-9]{7,20}" maxlength="20" required >
				</div>
		  	</div>
		</div>
        <div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombres</label>
				  	<input class="input" type="text" name="cliente_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Apellidos</label>
				  	<input class="input" type="text" name="cliente_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Telefono</label>
				  	<input class="input" type="tel" name="cliente_telefono" pattern="[0-9]{10}" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Email</label>
				  	<input class="input" type="email" name="cliente_email" required>
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Direccion</label>
				  	<input class="input" type="text" name="cliente_direccion" placeholder="Barrio, calle #nn-nn" maxlength="100" required>
				</div>
		  	</div>
            <div class="column">
		    	<div class="control">
					<label>Ciudad</label>
				  	<input class="input" type="text" name="cliente_ciudad"  maxlength="100" required >
				</div>
		    </div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>