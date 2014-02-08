<?php


$db = mysqli_connect("127.0.0.1", "china", "wohping", "china");
if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}


$ergebnis = mysqli_query($db, "SELECT name,beschreibung,preis FROM gericht");

echo "<div><b>Gerichte</b></div>";
echo "<form action='index.php'>
        <div>
            <input type='submit' value='Start'/>
        </div>
    </form>";
echo "<table border=5>
            <tr>
              <th>Gericht</th>
              <th>Beschreibung</th>
              <th>Preis</th>
            </tr>";

while($daten=mysqli_fetch_array($ergebnis)){
    
    echo "<tr>
            <td>".$daten['name']."</td>
            <td>".$daten['beschreibung']."</td>
            <td>".number_format(($daten['preis']/100), 2,',', '')." €</td>
         </tr>";
}
echo     "</table>";
?> 
