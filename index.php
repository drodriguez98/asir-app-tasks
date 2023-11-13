<?php session_start(); ?>

<?php include ("inc/header.php"); ?>
<?php include ("inc/database.php"); ?>
<?php include ("inc/functions.php"); ?>

<?php if (!isset($_SESSION['user'])) { header("Location: login.php"); } ?>

<?php 			

	$page = collect('page');		

	if ($page == "") { $page = 1; } 

	$firstTaskOfPage = ($page - 1) * NUMELEMENTS;	

	$taks = pagination ($firstTaskOfPage, NUMELEMENTS);

?>

	<body>

		<main class="container">

			<h1>Tasks list</h1>
			
			<div class="nav-container-index-1">
			
				<a href="insert.php" class="btn btn-success">Insert task</a>
				<a href="logout.php" class="btn btn-danger">Logout</a>
				
			</div>

			<table class="table">

				<thead>

					<tr>

						<th scope="col">#</th>
						<th scope="col">Name</th>
						<th scope="col">Description</th>
						<th scope="col">Priority</th>
						<th scope="col">Actions</th>

					</tr>

				</thead>

				<tbody>

					<?php

						foreach ($taks as $task) {		

						  $taskId = $task['taskId'];
						  $name = $task['name'];
						  $description = $task['description'];
						  $priority = $task['priority'];

					?>

						<tr>		
							<th scope="row"><?= $taskId ?></th>
							<td><?= $name ?></td>
							<td><?= $description ?></td>
							<td><?= $priority ?></td>
							<td>
								<div class="nav-container-index-2">
									<a href="edit.php?taskId=<?=$taskId ?>" class="btn btn-primary">Edit</a>
									<a href="delete.php?taskId=<?=$taskId ?>" class="btn btn-danger" onclick="return confirm ('Estás seguro de borrar la tarea <?=$taskId?>?');">Delete</a>
								</div>
							</td>
						</tr>

					<?php } ?>

				</tbody>

			</table>

			<nav aria-label="Page navigation example" class="pagination-nav">	

				<ul class="pagination">

					<?php $numPages = numPages(NUMELEMENTS); ?>

					<li class="page-item" <?php if ($page == 1) {print "disabled"; }?>> <a class="page-link" href="index.php?page=<?=$page - 1; ?>">Preview</a></li>

					<?php for ($i = 1; $i <= $numPages; $i++) { ?>

							<li class="page-item"><a class="page-link" href="index.php?page=<?=$i?>"><?php echo $i?></a></li>
						
					<?php } ?>

					<li class="page-item" <?php if ($page >= $numPages) {print "disabled"; }?>><a class="page-link" href="index.php?page=<?=$page + 1; ?>">Next</a></li>

				</ul>

			</nav> 
			
		</main>
	
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"  crossorigin="anonymous"></script>
	
	</body>

</html>