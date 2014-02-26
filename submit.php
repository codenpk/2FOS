<?php
	$uid = $_GET["uid"];
	$did = $_GET["did"];
	$qty = $_GET["qty"];
	$db = mysqli_connect("127.0.0.1", "china", "wohping", "china");
	if(!db)
	{
		die("connection error: ".mysqli_connect_error());
	}
	mysqli_query($db, "INSERT INTO orders (uid, did, amount) VALUE ($uid, $did, $qty)");
	mysqli_query($db, "update user set preferred_dish_id=$did where uid=$uid");
	header("Location: index.php?uid=$uid");
?>
