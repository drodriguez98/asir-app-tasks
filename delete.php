<?php session_start(); ?>

<?php include ('inc/functions.php'); ?>
<?php include ('inc/database.php'); ?>
<?php include ('inc/header.php'); ?>

<?php if (!isset($_SESSION['user'])) { header("Location: login.php"); } ?>

	<body>

		<main class="container">

			<h1>Delete task</h1>

			<?php

				$taskId = collect('taskId');
					
				$delete = deleteTask ($taskId);
					
				if ($delete) {  ?>	
						
					<div class="alert alert-success" role= "alert"> <h2>Task <?=$taskId ?> deleted </h2> </div>
						
					<p><a href='index.php' class='btn btn-success'>Go home</a></p>
									
				<?php } else { ?>
					
					<div class="alert alert-danger" role= "alert"> <p>Task <?=$taskId ?> not deleted. Try again..</p> </div>

				<?php } ?>
				
		</main>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"  crossorigin="anonymous"></script>
		
	</body>
	
</html>
