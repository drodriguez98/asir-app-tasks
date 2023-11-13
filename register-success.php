<?php session_start(); ?>

<?php include ('inc/database.php'); ?>
<?php include ("inc/header.php"); ?>

	<body>

		<main class="container">

			<h1>Account created</h1>

			<?php 

				echo "Wellcome ".$_SESSION['user'];

				echo '<br><br>';

			?>

			<a href="index.php" class="btn btn-success">Open application</a>
			
		</main>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"  crossorigin="anonymous"></script>
		
	</body>
	
</html>