<?php
	include_once 'functions.inc.php';

	if (!isset($_GET['id'])) {
		echo "<h1>No Record</h1>";
		exit();
	}

	$id = htmlspecialchars($_GET['id']);
	echo "<h1>Getting Image </h1>";
	$stmt = get_product_once($conn, $id);
	$image = $stmt->get_result()->fetch_assoc();
	$stmt->close();
?>