<?php session_start(); ?>

<?php include ('inc/database.php'); ?>
<?php include ('inc/functions.php'); ?>

<?php if (!isset($_SESSION['user'])) { header("Location: login.php"); } ?>

<?php function showForm ($name, $description, $priority) { ?>

    <form method="get">

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
        
        <button type="submit" class="btn btn-primary" name="btn-enviar">Insert</button>

    </form>

<?php } ?>

<?php include ('inc/header.php'); ?>

<h1>Insert task</h1>

<?php
	
    if (!isset($_REQUEST['btn-enviar'])) {

        $name = "";
        $description = "";
        $priority = "";

        showForm ($name, $description, $priority);
		

    } else {

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

            showForm ($name, $description, $priority);
        
        } else {

            $taskId = insertTask ($name, $description, $priority);
			
			if ($taskId) { 
			
            ?>	
				
				<div class="alert alert-s" role= "alert">
				
					<h2>Task <?=$taskId ?> inserted </h2>
                    
					<p><a href='index.php' class='btn btn-success'>Go home</a></p>
				
				</div>
				
            <?php } else { ?>
			
				<div class="alert alert-danger" role= "alert">
				
					<h2>Errors</h2>
					<p>Task not inserted</p>
					
				</div>
			
            <?php
			
				showForm ($name, $description, $priority);
			
			}
		
		}
	
	}
				
?>

<?php include ("inc/footer.php"); ?>