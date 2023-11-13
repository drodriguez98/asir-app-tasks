<?php session_start(); ?>

<?php include ('inc/functions.php'); ?>
<?php include ('inc/database.php'); ?>
<?php include ('inc/header.php'); ?>

<?php	

	if (!isset($_SESSION['user'])) {	header("Location: login.php"); }

?>

<?php function showForm ($taskId, $name, $description, $priority) { ?>

    <form method="get">

        <div class="mb-3">

        <label for="taskId" class="form-label">ID</label>
        <input type="text" class="form-control" id="taskId" name="taskId" value="<?=$taskId ?>" readonly="readonly" />

        </div>
		
		<div class="mb-3">

        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="">

        </div>

        <div class="mb-3">

        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" id="description" name="description" value="">

        </div>

        <div class="mb3">Priority</br>

            <div class="form-check form-check-inline">

                <input class="form-check-input" type="radio" name="priority" id="low" value="low" <?php if ($priority=="Low") {echo "checked='checked'";} ?>>
                <label class="form-check-label">Low</label>
                
            </div>

            <div class="form-check form-check-inline">

                <input class="form-check-input" type="radio" name="priority" id="medium" value="medium" <?php if ($priority=="Medium") {echo "checked='checked'";} ?>>
                <label class="form-check-label">Medium</label>
    
            </div>

                <div class="form-check form-check-inline">

                <input class="form-check-input" type="radio" name="priority" id="high" value="high" <?php if ($priority=="High") {echo "checked='checked'";} ?>>
                <label class="form-check-label">High</label>

            </div>

        </div>

        <br>
        
        <button type="submit" class="btn btn-primary" name="btn-enviar">Edit</button>

    </form>
	
<?php } ?>

<h1>Actualizar tarea</h1>

<?php

    if (!isset($_REQUEST['btn-enviar'])) {
		
		$taskId= collect('taskId');
		
		#	Si alguien intenta acceder directamente a la página sin el enlace de listado.php redirigimos a listado.php.
		
		if ($taskId == "") {
			
			header('Location: index.php');
			exit;
		
		}
		
		#	Pasamos el id que recogemos a la función seleccionar_tarea para obtener un array con los campos de la tarea con ese id. Si el array está vació redirigimos a listado.php. Si recibimos los datos en el array los recogemos.
		
		$task = selectTask($taskId);
		
		if (empty($task)) {
			
			header('Location: index.php');
			exit;
		
		} 
		
		$name = $task['nombre'];
        $description = $task['descripcion'];
        $priority = $task['prioridad'];

        showForm ($taskId, $name, $description, $priority);
	
	#	Una vez tenemos los datos antiguos, validamos los nuevos datos introducidos por el usuario.
	
    } else {
		
		$taskId= collect('id_tarea');
        $name = collect('nombre');
        $description = collect('descripcion');
        $priority = collect('prioridad');

        $errors = "";

        if ($name == "") {

            $errors.= "<li>Debes introducir un nombre</li>";

        }

        if ($description == "") {

            $errors.= "<li>Debes introducir una descripción</li>";

        }

        if ($priority == "") {

            $errors.= "<li>Debes introducir una prioridad</li>";

        }
		
		#	Comprobamos si hay errores y le damos estilo para mostrarlos.
		
        if ($errors != "") {
			
			echo "<div class='alert alert-danger' role= 'alert'>";
			
				echo "<ul>$errors</ul>";
				echo "</hr>";
			
			echo "</div>";

            showForm ($taskId, $name, $description, $priority);
        
        } 
		
		#	Si no hay ningún error intentamos hacer el update y mostramos un alert u otro en función de si la tarea se actualiza correctamente o no.
		
        else {

            $update = updateTask ($taskId, $name, $description, $priority);
			
			if ($update) { 
			
?>	
				
				<div class="alert alert-success" role= "alert">
				
					<h2>Task <?=$taskId ?> updated </h2>
				
				</div>
				
				<p><a href='index.php' class='btn btn-success'>Go home</a></p>
							
<?php
	
			} else {
				
?>
			
				<div class="alert alert-danger" role= "alert">
				
					<p>Task <?=$taskId ?> not updated. Try again.</p>
					
				</div>
<?php
				
				showForm ($taskId, $name, $description, $priority);

			}

		}
		
	}

?>

<?php include ("inc/footer.php"); ?>