<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirmLoggedIn(); ?>
<?php 
	if(intval($_GET['page']) == 0){
		redirectTo("content.php");
	}

	$id = mysql_prep($_GET['page']);

	if($page = getPageById($id)){

		$query = "DELETE FROM Pages WHERE id = {$id} LIMIT 1";
		$result = mysql_query($query, $connection);
		if(mysql_affected_rows() == 1){
			redirectTo("content.php");
		}else{
			// deletion failed
			echo "<p>Page deletion failed.</p>";
			echo "<p>" . mysql_error() . "</p>";
			echo "<a href=\"content.php\">Return to Main Page</a>";
		}
	}else {
		// subject didnt exit in database
		redirectTo("content.php");
	}
?>

<?php mysql_close($connection); ?>