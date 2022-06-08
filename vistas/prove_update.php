<div class="container is-fluid mb-6">
	<h1 class="title">proveedors</h1>
	<h2 class="subtitle">Actualizar proveedor</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['prove_id_up'])) ? $_GET['prove_id_up'] : 0;

		/*== Verificando proveedor ==*/
    	$check_proveedor=conexion();
    	$check_proveedor=$check_proveedor->query("SELECT * FROM proveedor WHERE proveedor_id='$id'");

        if($check_proveedor->rowCount()>0){
        	$datos=$check_proveedor->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/proveedor_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >
        <input type="hidden" name="prove_id" value="<?php echo $datos['proveedor_id']; ?>" required >
        <div class="columns">
            <div class="column">
		    	<div class="control">
					<label>Tipo de documento</label><br>
		    	    <div class="select">
				  	    <select name="proveedor_td" required readonly>
                            <?php
                                switch($datos['proveedor_td']){
                                    case"CC":
                                    echo'<option value="" disabled>Seleccione una opción</option>
                                        <option value="CC" selected>Cedula de ciudadania</option>
                                        <option value="NIT" >NIT</option>';
                                        
                                    break;
                                    
                                    case"NIT":
                                        echo'<option value="" disabled>Seleccione una opción</option>
                                            <option value="CC">Cedula de ciudadania</option>
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
				  	<input class="input" type="text" name="proveedor_documento"  pattern="[0-9]{7,20}" maxlength="20" value="<?php echo $datos['proveedor_documento']; ?>" required readonly>
				</div>
		  	</div>
		</div>
        <div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombres</label>
				  	<input class="input" type="text" name="proveedor_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" value="<?php echo $datos['proveedor_nombre']; ?>" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Telefono</label>
				  	<input class="input" type="tel" name="proveedor_telefono" pattern="[0-9]{10}" value="<?php echo $datos['proveedor_telefono']; ?>" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Email</label>
				  	<input class="input" type="email" name="proveedor_email" value="<?php echo $datos['proveedor_email']; ?>" required>
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Direccion</label>
				  	<input class="input" type="text" name="proveedor_direccion" maxlength="100" value="<?php echo $datos['proveedor_direccion']; ?>"required>
				</div>
		  	</div>
            <div class="column">
		    	<div class="control">
					<label>Ciudad</label>
				  	<input class="input" type="text" name="proveedor_ciudad"  maxlength="100" value="<?php echo $datos['proveedor_ciudad']; ?>" required >
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
		$check_proveedor=null;
	?>
</div>