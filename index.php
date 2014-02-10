<?php
	// this checks if the parameter bid= is submitted, if not it redirects to a site with empty parameter bid
	if(!isset($_GET["bid"])) 
	{
		header("Location: index.php?bid=");
	}
	
	// if the parameter bid is submitted but empty then ask the user to enter a valid bid
	else if($_GET["bid"] === "") 
	{
		die('Please enter your User-ID after bid= in the addressbox.');
	}
	else 
	{
		// at this point the parameter bid is submitted and not empty. let's save it in a variable
		$bid = $_GET["bid"];
		//time to ask the database what it thinks about that bid...	
		$db = mysqli_connect("127.0.0.1", "china", "wohping", "china");
		if(!db)
		{
			die("connection error: ".mysqli_connect_error());
		}
		$result = mysqli_query($db, "SELECT bid, kuerzel FROM benutzer WHERE bid='$bid'");
		// if the name exists in the database
		if(mysqli_num_rows($result) == 0)
		{
			die("Sorry , this User-ID is not in the database. Please try again...");
		}
		else 
		{
			$firstrow=mysqli_fetch_array($result);
			$name = $firstrow['kuerzel'];
			// the user exists, let's start!
			show_order();
		}
	}
	function show_order()
	{
		global $name, $bid, $db;
		$result = mysqli_query($db, "SELECT bid, name, beschreibung, anzahl, preis FROM get_all_orders WHERE bid LIKE '$bid'");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-15">
	</head>
	<body>
		<h1>My orders</h1>
		<p>Hello <?php echo $name; ?> </p>
		<table border=5>
			<tr>
				<th>dish</th>
				<th>description</th>
				<th>quantity</th>
				<th>price</th>
			</tr>
<?php
	while($daten=mysqli_fetch_array($result))
	{
		echo "<tr>
		<td>".$daten['name']."</td>
		<td>".$daten['beschreibung']."</td>
		<td>".$daten['anzahl']."</td>
		<td>".number_format(($daten['preis']/100), 2,',', '').""; echo chr(164); echo "</td></tr>";
	}
?>
		</table>
		<br/>
		<form action='order.php'>
			<input type='submit' value='Add order' />
			<input type='hidden' name='bid' value='<?php echo $bid; ?>' />
		</form>
	</body>
</html>
<?php
	}
?>
