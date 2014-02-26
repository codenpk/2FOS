<?php
		$db = mysqli_connect("127.0.0.1", "china", "wohping", "china");
		if(!db)
		{
			die("connection error: ".mysqli_connect_error());
		}
		$result = mysqli_query($db, "SELECT name, description , SUM(amount) amount FROM get_orders GROUP BY did");
	?>
<!DOCTYPE html>
<html class="no-js" lang="en">

    <!--  Head-->  
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="ISO-8859-15"/>
        <title>2FOS summary</title>
        <link rel="stylesheet" href="css/foundation.css" />
        <script src="js/vendor/modernizr.js"></script>
    </head>
  
    <body>
      
    <!-- Top-Bar -->    
    <div class="fixed">
        <nav class="top-bar" data-topbar>
            <ul class="title-area">
                <li class="name">
                    <h1><a href="#">2FOS //summary</a></h1></li>
            </ul>
        </nav>
    </div>

    <!-- "summary of all orders" -->  
    <div class="row" style="margin-top:60px">
        <div class="small-12 columns">
            <div class="panel">
                <h2>summary</h2>
                <?php
                //there are orders, so display them
						echo "<div class=\"row\">
								<div class=\"small-12 columns\">
									<table width=100%>
										<thead><tr><th width=8%>dish</th><th>description</th><th width=8%>amount</th></tr></thead>";
										while($currentrow=mysqli_fetch_array($result))
										{
											echo "<tr>
													<td>".$currentrow['name']."</td>
													<td>".$currentrow['description']." ".$currentrow['long_description']."</td>
													<td>".$currentrow['amount']."</td>
												</tr>";
										}
										
										
						echo"		</table>
								</div>
							</div>";
					
                ?>
  </div>
 </div>
 </div>
