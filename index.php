<?php

$db = mysqli_connect("localhost", "china", "wohping", "china");

if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}

$ergebnis = mysqli_query($db, "SELECT kuerzel,bid FROM benutzer");

echo "<div><b>Meine Bestellungen</b></div>";
echo "<form action='Gericht.php'>
    <div>
         <input type='submit' value='Gericht' />
    </div>
</form>";
echo "<table border=5>
            <tr>
              <th>BID</th>
              <th>Nachname</th>
            </tr>";

while($daten=mysqli_fetch_array($ergebnis)){
    
    echo "<tr>
            <td>".$daten['bid']."</td>
            <td>".$daten['kuerzel']."</td>
         </tr>";
}
echo     "</table>";
?>