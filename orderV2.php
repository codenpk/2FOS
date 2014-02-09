<!doctype html>
<?php


$db = mysqli_connect("localhost", "china", "wohping", "china");
if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}

if($_POST['nameFood']==""){
    $Food="";
}
else{
    $Food="WHERE beschreibung='".$_POST['nameFood']."'";
}
$_POST['nameFood']=$GID;

$ergebnis = mysqli_query($db, "SELECT name,beschreibung,preis FROM gericht $Food");

$insertErgebnis = mysqli_query($db, "INSERT into bestellung (gid,bid,anzahl) value ($GID,$BID,$Anzahl)");

?>
<html class="no-js" lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
      <nav class="top-bar" data-topbar>
         <ul class="title-area">
            <li class="name">
                <h1><a href="#">2FOS</a></h1></li>
            <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
        </ul>
      </nav>
      
        <div class="row">
            <div class="large-7 columns">
                <div class="panel">
                    <h2>Meine Bestellungen</h2>
                    <div class="panel callout radius">
                        <p>Fügen Sie eine Bestellung hinzu!</p>
                    </div>
                    <form action="order.php" method="POST">
                        <p>Nummer des Gerichts: <br><input name="number1Food" class="large-4 columns" type="text" size="10" maxlength="30"></p>
                         <p>Anzahl der Gerichte: <br><input name="number2Food" class="large-4 columns" type="text" size="10" maxlength="30"></p>
                        <input class="button [tiny small large]" type="submit" name="nameFood" value=" Suchen ">
                    </form>
                </div>
            </div>
            <div class="large-5 columns">
                <div class="panel">
            <form action="order.php" method="POST">
                <p>Suche:<br><input name="nameFood" type="text" maxlength="30"></p>
                <input class="button [tiny small large]" type="submit" name="getFood" value=" Suchen ">
            </form>
       
            <?php
                 echo "<table>
                        <tr>
                          <th>Gericht</th>
                          <th>Beschreibung</th>
                          <th>Preis</th>
                        </tr>";

                while($daten=mysqli_fetch_array($ergebnis)){

                echo "<tr>
                        <td>".$daten['name']."</td>
                        <td>".$daten['beschreibung']."</td>
                        <td>".number_format(($daten['preis']/100), 2,',', '')." echo chr(164)</td>
                     </tr>";
                }
                echo     "</table>";
            ?>
            </div>
         </div>
     </div>
