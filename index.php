<?php
	// this checks if the parameter kuerzel= is submitted, if not it redirects to a site with empty parameter kuerzel
	if(!isset($_GET["kuerzel"])) 
	{
		header("Location: index.php?kuerzel=");
	}
	
	// if the parameter kuerzel is submitted but empty then ask the user to enter a valid kuerzel
	else if($_GET["kuerzel"] === "") 
	{
		die('Please enter your username after kuerzel= in the addressbox.');
	}
	else 
	{
		// at this point the parameter kuerzel is submitted and not empty. let's save it in variable
		$kuerzel = $_GET["kuerzel"];
		//time to ask the database what it thinks about that name...	
		$db = mysqli_connect("127.0.0.1", "china", "wohping", "china");
		if(!db)
		{
			die("Verbindungsfehler: ".mysqli_connect_error());
		}
		$result = mysqli_query($db, "SELECT kuerzel FROM benutzer WHERE kuerzel LIKE '$kuerzel'");
		// if the name exists in the database
		if(mysqli_num_rows($result) == 0)
		{
			die("Sorry ".$kuerzel.", this name is not in the database. Please try again...");
		}
		else 
		{
			$firstrow = $result->fetch_array();
			$name = $firstrow['kuerzel'];
			$bid = $firstrow['bid'];
			show_order();
		}
	}
	function show_order()
	{
		global $name;
		global $db;
		$result = mysqli_query($db, "SELECT name, beschreibung, anzahl, anzahl * preis AS preis FROM get_all_orders WHERE kuerzel LIKE '$name'");
		echo "<html><head><meta http-equiv=\"content-type\" content=\"text/html; charset=ISO-8859-15\"></head><body><h1>Meine Bestellungen</h1>";
		echo "<table border=5><tr><th>Gericht</th><th>Beschreibung</th><th>Anzahl</th><th>Preis</th></tr>";

		while($daten=mysqli_fetch_array($result))
		{
			echo "<tr>
			<td>".$daten['name']."</td>
			<td>".$daten['beschreibung']."</td>
			<td>".$daten['anzahl']."</td>
			<td>".number_format(($daten['preis']/100), 2,',', '').""; echo chr(164); echo "</td></tr>";
		}
		echo "</table></br><form action='gericht.php?kuerzel=$name'><div><input type='submit' value='Add order' /></div></form></body> </html>";
	}
?>
