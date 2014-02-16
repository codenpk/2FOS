<!doctype html>

<?php
//Connect to database
$db = mysqli_connect("localhost", "china", "wohping", "china");
if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}

//Is there an input for "Suche"
if(isset($_POST['nameGID'])){
    //Edit the SQL - Statement
   $Food="WHERE name='".$_POST['nameGID']."'"; 
}else{
    if(isset($_POST['nameFood'])){
        //Edit the SQL - Statement
        $Food="WHERE beschreibung='".$_POST['nameFood']."'"; 
    }

    else{
        //Do not add anything
        $Food="";
    }
}
//Get data for the tables
$ergebnis = mysqli_query($db, "SELECT gid,name,beschreibung,preis FROM gericht $Food");
$historieErgebnis = mysqli_query($db, "SELECT bid,gid,anzahl FROM bestellung WHERE bid=1");

//Is there a value for "Bestellen"
if(isset($_POST['number1Food']) && isset($_POST['number2Food'])){
 
    $GID=$_POST['number1Food'];
    $Anzahl=$_POST['number2Food'];
    
    //INSERT the new value
    $insertErgebnis = mysqli_query($db, "INSERT into bestellung (gid,bid,anzahl) value ($GID,1,$Anzahl)");
    
    $eintragen = mysql_query($insertErgebnis);
}
?>

<html class="no-js" lang="en">
    
    <!--  Head-->  
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>2FOS Meine Bestellungen</title>
        <link rel="stylesheet" href="css/foundation.css" />
        <script src="js/vendor/modernizr.js"></script>
    </head>
  
    <body>
      
    <!-- Tob-Bar -->    
    <div class="fixed">
        <nav class="top-bar" data-topbar>
            <ul class="title-area">
                <li class="name">
                    <h1><a href="#">2FOS</a></h1></li>
                <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
            </ul>
        </nav>
    </div>

    <!-- "Meine Bestellungen" -->  
    <div class="row" style="margin-top:60px">
        <div class="large-6 columns">
            <div class="panel">
                <h2>Meine Bestellungen</h2>
                <div class="panel callout radius">
                    <p>Fügen Sie eine Bestellung hinzu!</p>
                </div>
                
                <!-- Buttons and Lables -->
                <form action="order.php" method="POST">
                    <p>Nummer des Gerichts: <br><input name="number1Food" class="large-4 columns" type="text" size="10" maxlength="30"></p>
                    <p>Anzahl der Gerichte: <br><input name="number2Food" class="large-4 columns" type="text" size="10" maxlength="30"></p>
                    <input class="button [tiny small large]" type="submit" name="orderFood" value=" Bestellen ">
                </form>
            </div>
          
            <!-- "Bstellhistorie" -->
            <div class="large-12 columns">
                <div class="row">
                    <div class="panel">
                        <h1>Bestellhistorie</h1>

                        <?php
                        echo "<table>
                               <tr>
                                 <th>Benutzer</th>
                                 <th>Gericht</th>
                                 <th>Preis</th>
                               </tr>";

                        //Tabelle mit Daten füllen
                        while($daten=mysqli_fetch_array($historieErgebnis)){

                        echo "<tr>
                                <td>".$daten['bid']."</td>
                                <td>".$daten['gid']."</td>
                                <td>".$daten['anzahl']."</td>
                             </tr>";
                        }
                        echo     "</table>";
                        ?>

                    </div>
                </div>    
            </div>
        </div>
        
        <!-- Gericht Suchen -->
        <div class="large-6 columns" >
            <div class="panel" style="position:fixed">
                <h2>Gericht Suchen</h2>
                
                <!-- Buttons and Lables -->
                <div class="row">
                    
                    <!-- Suchen="Beschreibung" -->
                    <div class="medium-6 columns">
                        <form action="order.php" method="POST">
                            <p>Beschreibung:<br><input name="nameFood" type="text" maxlength="30"></p>
                            <input class="button [tiny small large]" type="submit" name="getFood" value=" Suchen ">
                        </form>
                    </div>
                    
                    <!-- Suchen="Gericht ID" -->
                    <div class="medium-6 columns">
                        <form action="order.php" method="POST">
                            <p>Gericht ID:<br><input name="nameGID" type="text" maxlength="30"></p>
                            <input class="button [tiny small large]" type="submit" name="getGID" value=" Suchen ">
                        </form>
                    </div>
                    
                </div>

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
