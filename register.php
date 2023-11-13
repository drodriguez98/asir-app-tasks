<?php session_start(); ?>

<?php include ('inc/functions.php'); ?>
<?php include ('inc/database.php'); ?>
<?php include ('inc/header.php'); ?>

<?php function showForm ($name, $username, $password) { ?>

	<form method="get">
	
		<div class="mb-3">

			<label for="name" class="form-label">Enter your name</label>
			<input type="text" class="form-control" id="name" name="name" value="<?=$name ?>"/>

		</div>

		<div class="mb-3">

			<label for="username" class="form-label">Enter a username</label>
			<input type="text" class="form-control" id="username" name="username" value="<?=$username ?>"/>

		</div>
		
		<div class="mb-3">

			<label for="password" class="form-label">Enter a password</label>
			<input type="password" class="form-control" id="password" name="password" value="<?=$password ?>">

		</div>

		<br>
		
		<div class="nav-container">

			<button type="submit" class="btn btn-primary" name="btn-enviar">Register</button>
		
		</div>

	</form>

<?php } ?>

	<body>

		<main class="container">

		<h1 class="mt-3 text-center">Register</h1>

		<?php

			if (!isset($_REQUEST['btn-enviar'])) {

				$name = "";
				$username = "";	
				$password = "";
				
				showForm ($name, $username, $password);
			
			} else {		

				$name = collect('name');	
				$username = collect('username');	
				$password = collect('password');

				$errors = "";	
				
				if ($name == "") { $errors.= "<li>Debes introducir un nombre</li>"; }

				if ($username == "") {
			
					$errors.= "<li>Debes introducir un usuario</li>";
			
				} else {

					$repeated = selectUser ($username);

					if ($repeated) { $errors.= "<li>Ya existe un usuario con ese nombre</li>"; }

				}
			
				if ($password == "")  { $errors.= "<li>Debes introducir una contraseña</li>"; }

				if ($errors != "") {		
					
					echo "<div class='alert alert-danger' role='alert'>";

						echo "<ul>$errors</ul>";
						echo "</hr>";

					echo "</div>";

					showForm ($name, $username, $password);
				
				} else {

					$register = register ($name, $username, $password);

					if ($register == 0) {	

						echo "<p>No se ha podido realizar la operación</p>";

					} else {	

						$_SESSION['user'] = $username;
						header("Location: register-success.php");

					}

				}

			}

		?>
		
		</main>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"  crossorigin="anonymous"></script>
		
	</body>
	
</html>