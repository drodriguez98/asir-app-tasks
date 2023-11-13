<?php session_start(); ?>

<?php include ('inc/functions.php'); ?>
<?php include ('inc/database.php'); ?>
<?php include ('inc/header.php'); ?>

<?php	

	if (!isset($_SESSION['user'])) { header("Location: login.php"); }

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
        
        <div class="nav-container-edit"> <button type="submit" class="btn btn-primary" name="btn-enviar">Edit</button> </div>
		
    </form>
	
<?php } ?>

	<body>

		<main class="container">

			<h1>Actualizar tarea</h1>

			<?php

				if (!isset($_REQUEST['btn-enviar'])) {
					
					$taskId= collect('taskId');
					
					if ($taskId == "") {
						
						header('Location: index.php');
						exit;
					
					}
					
					$task = selectTask($taskId);
					
					if (empty($task)) {
						
						header('Location: index.php');
						exit;
					
					} 
					
					$name = $task['name'];
					$description = $task['description'];
					$priority = $task['priority'];

					showForm ($taskId, $name, $description, $priority);
				
				} else {
					
					$taskId= collect('taskId');
					$name = collect('name');
					$description = collect('description');
					$priority = collect('priority');

					$errors = "";

					if ($name == "") { $errors.= "<li>Debes introducir un nombre</li>"; }

					if ($description == "") { $errors.= "<li>Debes introducir una descripción</li>"; }

					if ($priority == "") { $errors.= "<li>Debes introducir una prioridad</li>"; }
					
					if ($errors != "") {
						
						echo "<div class='alert alert-danger' role= 'alert'>";
						
							echo "<ul>$errors</ul>";
							echo "</hr>";
						
						echo "</div>";

						showForm ($taskId, $name, $description, $priority);
					
					} else {

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
			
		</main>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"  crossorigin="anonymous"></script>
		
	</body>

</html>