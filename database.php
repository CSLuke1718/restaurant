<!DOCTYPE html>

<html>
<head>
	<meta charset = "utf-8">
	<title>Database form</title>
	<link rel="stylesheet" href="CSS style.css">
	<!-- <style type = "text/css">
        table { background-color: lightblue; border-collapse: collapse; border: 1px solid gray; }
        td    { padding: 5px; }
        tr:nth-child(odd) {background-color: white; } <!-- alternate colors for different rows.
	</style> -->
</head>
<body>
	<?php
		$select = $_POST["select"];
		$table = $_POST["table"];
		
		if($select == '*')
			$query = "SELECT ".$select." FROM ".$table.";";
		else
			$query = "SELECT DISTINCT(".$select.") FROM ".$table.";";
		
		if(!($database = mysqli_connect("localhost",
            "bonnie", "bon", "Restaurant")))
			die( "Could not connect to database </body></html>" );
		
		if ( !mysqli_select_db( $database, "Restaurant" ) )
            die( "Could not open Luke database </body></html>" );
		
		if ( !( $result = mysqli_query( $database, $query )))
        {
			print( "<p>Could not execute query!</p>" );
			die( mysqli_error() . "</body></html>" );
        }
		
		mysqli_close( $database );
	?>
	<table width="100%" border="1">
  <tbody>
    <tr>
      <td colspan="2" style="text-align: center; color: #0E279C;"><h1>The Onkyo Diner</h1></td>
    </tr>
	<tr>
      <td colspan="2" style="text-align: center;">
      <div class ="topnav" >
      <a href="ProjHome.html">Home</a>
      <a href="projmenu.html">Menu</a>
      <a href="projlocation.html">Location</a>
	  <a href="projvideo.html">Video</a>
		<a class="active" href="databaseQuery.html">Database</a>
		<a href="MailingListForm.php">Subscribe</a>
		<div class="dropdown" style="">
			<button class="dropbtn"><a href="#">Assignments </a><i class="fa fa-caret-down"></i></button>
			<div class="dropdown-content">
				<a href="Assignment1Proj.zip">Assignment 1</a>
				<a href="Assignment2Proj.zip">Assignment 2</a>
				<a href="Assignment3Proj.zip">Assignment 3</a>
				<a href="Assignment4Proj.zip">Assignment 4</a>
				<a href="Assignment5Proj.zip">Assignment 5</a>
			</div>
		</div>
      </div>
      </td>
    </tr>
	<tr>
	<td>
	<table style="margin: auto; text-align: left;">
		<thead>Results of SELECT <?php print("$select") ?> from the <?php print("$select") ?> table of the Restaurant Database</thead>
		<tbody>
		<?php
            //while rows from the query, print them out
			while ( $row = mysqli_fetch_row( $result ) )
            {
				print( "<tr>" );
				foreach ( $row as $value )
					print( "<td style=\"fit-content; block-size: fit-content;\">$value</td>" );
				print( "</tr>" );
            }
		?>
		</tbody>
	</table>
	<p>Your Search yielded <?php print( mysqli_num_rows( $result )) ?> results.</p>
	</td>
	</tr>
   </table>
  </tbody>
</body>
</html>
