<?php
// First, let's connect to the database
$db = mysqli_connect("127.0.0.1", "china", "wohping", "china");
if(!$db)
{
  exit("connection error: ".mysqli_connect_error());
}
// are the POST Values set?
if(isset($_POST['gid']) && isset($_POST['quantity']) && isset($_POST['bid']))
{
    $quantity = $_POST['quantity'];
    $gid = $_POST['gid'];
    $bid = $_POST['bid'];
    
    
    //INSERT the new value
    $insertErgebnis = mysqli_query($db, "INSERT INTO bestellung (bid,gid,anzahl) VALUE ($bid, $gid, $quantity)");
    // and redirect to the index.php
    header("Location: index.php?bid=$bid");
}
// If not work with the get values and offer the option to add an order
else {
	
	// this checks if the parameter bid= is submitted, if not it redirects to a site with empty parameter bid
	if(!isset($_GET["bid"])) 
	{
		header("Location: order.php?bid=");
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
	}
?>

<!DOCTYPE html>
<html>
    <head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-15">
    </head>
    <body>
	<h1>Add an order:</h1>
	<table border=5>
            <tr>
              <th>gid</th>
              <th>Gericht</th>
              <th>Beschreibung</th>
              <th>Preis</th>
            </tr>
<?php
$ergebnis = mysqli_query($db, "SELECT gid, name,beschreibung,preis FROM gericht");
while($daten=mysqli_fetch_array($ergebnis))
{
    echo "<tr>
	    <td>".$daten['gid']."</td>
	    <td>".$daten['name']."</td>
	    <td>".$daten['beschreibung']."</td>
	    <td>".number_format(($daten['preis']/100), 2,',', '')."";echo chr(164);echo "</td>
	  </tr>";
}?>
	</table>
	<p>
	    <form name="input" action="order.php" method="POST">
	GID: <input type="text" name="gid">
	Anzahl: <input type="text" name="quantity">
	<input type="hidden" name="bid" value="<?php echo $bid; ?>">
	<input type="submit" value="Submit">
</form>
</html>

<?php
// don't forget we are in a big else section beginning in line 22
}
?>

