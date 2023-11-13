<?php session_start(); ?>

<?php include ('inc/functions.php'); ?>
<?php include ('inc/database.php'); ?>
<?php include ('inc/header.php'); ?>


<!--		Función para mostrar el formulario de login		-->

<?php function showForm ($username, $password) { ?>

	<form method="get">

		<div class="mb-3">

		<label for="username" class="form-label">Enter your username</label>
		<input type="text" class="form-control" id="username" name="username" value="<?=$username ?>"/>

		</div>
		
		<div class="mb-3">

		<label for="password" class="form-label">Enter your password </label>
		<input type="password" class="form-control" id="password" name="password" value="<?=$password ?>">

		<br>

		<button type="submit" class="btn btn-primary" name="btn-enviar">Login</button>

		<a href="register.php" class="btn btn-success">I have not an account</a>

	</form>

<?php } ?>

<h1 class="mt-3 text-center">Login</h1>

<?php

    if (!isset($_REQUEST['btn-enviar'])) {		

		$username = "";	
		$password = "";
		
        showForm ($username, $password);
	
	} else {		

		$username = collect('username');	
		$password = collect('password');

		$errors = "";	

		if ($username == "") { $errors.= "<li>Debes introducir un usuario</li>"; }
	
		if ($password == "") { $errors.= "<li>Debes introducir una contraseña</li>"; }

		if ($errors != "") {		
			
			echo "<div class='alert alert-danger' role='alert'>";
			
				echo "<ul>$errors</ul>";
				echo "</hr>";
			
			echo "</div>";

			showForm ($username, $password);
        
        } else {		

			$login = login ($username, $password);	

			if ($login == 0) {	

				echo "<p>Usuario y/o password incorrectos</p>";

			} else {	

				$_SESSION['user'] = $username;
				header("Location: index.php");

			}

		}

	}

?>

	</body>

</html>

<?php include("inc/footer.php"); ?>