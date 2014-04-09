<?php
	header('Content-Type: text/html; charset=utf-8');
	// this checks if the parameter uid= is submitted, if not it redirects to a site with empty parameter uid
	if(!isset($_GET["uid"]))
	{
		header("Location: index.php?uid=");
	}

	// if the parameter uid is submitted but empty then ask the user to enter a valid uid
	else if($_GET["uid"] === "")
	{
		die('Please enter your User-ID after uid= in the addressbox.');
	}
	else
	{
		// at this point the parameter uid is submitted and not empty. let's save it in a variable
		$uid = $_GET["uid"];
		//time to ask the database what it thinks about that uid...
		$db = mysqli_connect("127.0.0.1", "china", "wohping", "china");
		if(!db)
		{
			die("connection error: ".mysqli_connect_error());
		}
		mysql_query("SET character_set_results=utf8", $db);
    		mb_language('uni'); 
    		mb_internal_encoding('UTF-8');
    		mysql_select_db($argDB, $db);
    		mysql_query("set names 'utf8'",$db);
		$result = mysqli_query($db, "SELECT uid, prename FROM user WHERE uid='$uid'");
		// if the name exists in the database
		if(mysqli_num_rows($result) == 0)
		{
			die("Sorry , this User-ID is not in the database. Please try again...");
		}
		else
		{
			$firstrow=mysqli_fetch_array($result);
			$name = $firstrow['prename'];
			// the user exists, let's start!
			show_orders();
		}
	}
	
	function show_orders()
	{
		global $name, $uid, $db, $result;
		$result = mysqli_query($db, "SELECT * FROM get_orders WHERE uid='$uid'");
	}
	?>
<!DOCTYPE html>
<html class="no-js" lang="en">

    <!--  Head-->  
    <head>
	<meta http-equiv="content-type" content="text/html; charset=latin-1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>2FOS My orders</title>
        <link rel="stylesheet" href="css/foundation.css" />
        <script src="js/vendor/modernizr.js"></script>
    </head>
  
    <body>
      
    <!-- Top-Bar -->    
    <div class="fixed">
        <nav class="top-bar" data-topbar>
            <ul class="title-area">
                <li class="name">
                    <h1><a href="#">2FOS <?php echo "//".$name.""; ?></a></h1></li>
            </ul>
        </nav>
    </div>

    <!-- "My orders" -->  
    <div class="row" style="margin-top:60px">
        <div class="small-12 columns">
            <div class="panel">
                <h2>My orders</h2>
                <?php
					$result = mysqli_query($db, "select * from get_orders where uid='$uid'");
					if(mysqli_num_rows($result) == 0)
					{
						//this should be displayed if nothing is ordered yet
						echo "<div class=\"panel callout radius\">
								<p>nothing ordered yet. Use the dropdown-menu to order some delicious chinese food ^-^</p>
							</div>";
					}
					else
					{
						//there are orders, so display them
						echo "<div class=\"row\">
								<div class=\"small-12 columns\">
									<table width=100%>
										<thead><tr><th width=8%>dish</th><th>description</th><th width=8%>amount</th><th width=8%>price</th></tr></thead>";
										while($currentrow=mysqli_fetch_array($result))
										{
											echo "<tr>
													<td>".$currentrow['name']."</td>
													<td>".$currentrow['description']." ".$currentrow['long_description']."</td>
													<td>".$currentrow['amount']."</td>
													<td>".number_format(($currentrow['price']/100), 2,',', '').""; echo "&euro;"; echo "</td>
											</tr>";
										}
										
										
						echo"		</table>
								</div>
							</div>";
					}
                ?>
                 <span class="label">Add an order:</span>
                <!-- Buttons and Lables -->
                <div class="row">
                    <div class="small-6 large-10 columns">
						<form action="submit.php" method="get">
                        <select name="did">
								<?php
									//now we have to fetch all available dishes from the database:
									$result = mysqli_query($db, "select * from dish");
									while($currentrow=mysqli_fetch_array($result))
										{
											echo "<option value=\"".$currentrow['did']."\">".$currentrow['name']." - ".$currentrow['description']." ".$currentrow['long_description'].", ".number_format(($currentrow['price']/100), 2,',', '').""; echo "&euro;"; echo "</option>";
										}
								?>                              
                            </select>
                    </div>
                    <div class="small-6 large-2 columns">
                        <div class="row collapse">
                            <div class="small-7 columns">
                                <input type="number" name="qty" placeholder="amount">
                                <input type='hidden' name='uid' value='<?php echo $uid; ?>' />
                            </div>
                            <div class="small-5 columns">
                            <input type="submit" class="button postfix" value="Go"/><form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
