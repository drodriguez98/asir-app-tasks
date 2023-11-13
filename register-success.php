<?php session_start(); ?>

<?php include ('inc/database.php'); ?>
<?php include ("inc/header.php"); ?>

<h1>Account created</h1>

<?php 

    echo "Wellcome ".$_SESSION['user'];

    echo '<br><br>';

?>

<a href="index.php" class="btn btn-success">Open application</a>