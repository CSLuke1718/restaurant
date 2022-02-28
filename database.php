<!DOCTYPE html>

<html>
<head>
	<meta charset = "utf-8">
	<title>Database form</title>
	<style type = "text/css">
        table { background-color: lightblue; border-collapse: collapse; border: 1px solid gray; }
        td    { padding: 5px; }
        tr:nth-child(odd) {background-color: white; } <!-- alternate colors for different rows. -->
	</style>
</head>
<body>
	<?php
		$select = $_POST["select"];
		
		if($select == '*')
			$query = "SELECT ".$select." FROM Customers";
		else
			$query = "SELECT DISTINCT(".$select.") FROM Customers";
		
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
	<table>
		<thead>Results of SELECT <?php print("$select") ?> from the Restaurant Database</thead>
		<?php
            //while rows from the query, print them out
			while ( $row = mysqli_fetch_row( $result ) )
            {
				print( "<tr>" );
				foreach ( $row as $value )
					print( "<td>$value</td>" );
				print( "</tr>" );
            }
		?>
	</table>
	<p>Your Search yielded <?php print( mysqli_num_rows( $result )) ?> results.</p>
	<p>Return to the <a href="Projhome.html">home page</a></p>
	
</body>
</html>