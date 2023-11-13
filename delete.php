<?php session_start(); ?>

<?php include ('inc/functions.php'); ?>
<?php include ('inc/database.php'); ?>
<?php include ('inc/header.php'); ?>

<?php if (!isset($_SESSION['user'])) { header("Location: login.php"); } ?>

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

<?php include ("inc/footer.php"); ?>