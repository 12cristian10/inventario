<div class="container is-fluid mb-6">
	<h1 class="title">Clientes</h1>
	<h2 class="subtitle">Actualizar cliente</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['client_id_up'])) ? $_GET['client_id_up'] : 0;

		/*== Verificando cliente ==*/
    	$check_cliente=conexion();
    	$check_cliente=$check_cliente->query("SELECT * FROM cliente WHERE cliente_id='$id'");

        if($check_cliente->rowCount()>0){
        	$datos=$check_cliente->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/cliente_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >
        <input type="hidden" name="client_id" value="<?php echo $datos['cliente_id']; ?>" required >
        <div class="columns">
            <div class="column">
		    	<div class="control">
					<label>Tipo de documento</label><br>
		    	    <div class="select">
				  	    <select name="cliente_td" required readonly>
                            <?php
                                switch($datos['cliente_td']){
                                    case"CC":
                                    echo'<option value="" disabled>Seleccione una opción</option>
                                        <option value="CC" selected>Cedula de ciudadania</option>
                                        <option value="CE" >Cedula de extrangeria</option>
                                        <option value="DE" >Documento extranjero</option>
                                        <option value="PAS" >Pasaporte</option>
                                        <option value="NIT" >NIT</option>';
                                        
                                    break;
                                    case"CE":
                                        echo'<option value="" disabled>Seleccione una opción</option>
                                            <option value="CC">Cedula de ciudadania</option>
                                            <option value="CE" selected>Cedula de extrangeria</option>
                                            <option value="DE" >Documento extranjero</option>
                                            <option value="PAS" >Pasaporte</option>
                                            <option value="NIT" >NIT</option>';
                                            
                                    break;
                                    case"DE":
                                        echo'<option value="" disabled>Seleccione una opción</option>
                                            <option value="CC">Cedula de ciudadania</option>
                                            <option value="CE" >Cedula de extrangeria</option>
                                            <option value="DE" selected>Documento extranjero</option>
                                            <option value="PAS" >Pasaporte</option>
                                            <option value="NIT" >NIT</option>';
                                            
                                    break;
                                    case"PAS":
                                        echo'<option value="" disabled>Seleccione una opción</option>
                                            <option value="CC">Cedula de ciudadania</option>
                                            <option value="CE" >Cedula de extrangeria</option>
                                            <option value="DE" >Documento extranjero</option>
                                            <option value="PAS" selected>Pasaporte</option>
                                            <option value="NIT" >NIT</option>';
                                            
                                    break;
                                    case"NIT":
                                        echo'<option value="" disabled>Seleccione una opción</option>
                                            <option value="CC">Cedula de ciudadania</option>
                                            <option value="CE" >Cedula de extrangeria</option>
                                            <option value="DE" >Documento extranjero</option>
                                            <option value="PAS" >Pasaporte</option>
                                            <option value="NIT" selected>NIT</option>';
                                            
                                    break;

                                } 
                            ?>

				  	    </select>
				    </div>
				</div>
		  	</div>
            <div class="column">
		    	<div class="control">
					<label>Numero de documento</label>
				  	<input class="input" type="text" name="cliente_documento"  pattern="[0-9]{7,20}" maxlength="20" value="<?php echo $datos['cliente_documento']; ?>" required readonly>
				</div>
		  	</div>
		</div>
        <div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombres</label>
				  	<input class="input" type="text" name="cliente_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" value="<?php echo $datos['cliente_nombre']; ?>" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Apellidos</label>
				  	<input class="input" type="text" name="cliente_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" value="<?php echo $datos['cliente_apellido']; ?>" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Telefono</label>
				  	<input class="input" type="tel" name="cliente_telefono" pattern="[0-9]{10}" value="<?php echo $datos['cliente_telefono']; ?>" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Email</label>
				  	<input class="input" type="email" name="cliente_email" value="<?php echo $datos['cliente_email']; ?>" required>
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Direccion</label>
				  	<input class="input" type="text" name="cliente_direccion" maxlength="100" value="<?php echo $datos['cliente_direccion']; ?>"required>
				</div>
		  	</div>
            <div class="column">
		    	<div class="control">
					<label>Ciudad</label>
				  	<input class="input" type="text" name="cliente_ciudad"  maxlength="100" value="<?php echo $datos['cliente_ciudad']; ?>" required >
				</div>
		    </div>
		</div>

		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_cliente=null;
	?>
</div>