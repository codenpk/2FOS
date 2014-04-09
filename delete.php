<?php
	$uid = $_GET["uid"];
	$oid = $_GET["did"];
	$db = mysqli_connect("127.0.0.1", "china", "wohping", "china");
	if(!db)
	{
		die("connection error: ".mysqli_connect_error());
	}
	mysqli_query($db, "DELETE FROM orders WHERE oid=$oid AND uid=$uid");
	header("Location: index.php?uid=$uid");
?>
