<?php session_start(); ?>

<?php include ('inc/database.php'); ?>
<?php include ("inc/header.php"); ?>


	<body>

		<main class="container">

			<h1>Session finished</h1>

			<?php 

				echo "Good bye ".$_SESSION['user'];

				echo "<br><br>";

				unset($_SESSION['user']);

			?>

			<a href="login.php" class="btn btn-success">Login</a>
			
		</main>
		
	</body>
	
</html>