<!DOCTYPE html>


<html>
<head>
    <title>Mailing List Database</title>
    <link rel="stylesheet" href="CSS style.css">
</head>
<body>
  <table width="100%" border="1">
  <tbody>
    <tr>
      <td colspan="2" style="text-align: center; color: #0E279C;"><h1>The Onkyo Diner</h1></td>
    </tr>
	<tr>
      <td colspan="2" style="text-align: center">
      <div class ="topnav">
      <a href="ProjHome.html">Home</a>
      <a href="projmenu.html">Menu</a>
      <a href="projlocation.html">Location</a>
	  <a href="projvideo.html">Video</a>
		<a href="databaseQuery.html">Database</a>
		<a class="active" href="MailingListForm.php">Subscribe</a>
		<div class="dropdown" style="">
			<button class="dropbtn"><a href="#">Assignments </a><i class="fa fa-caret-down"></i></button>
			<div class="dropdown-content">
				<a href="Assignments/Assignment1Proj.zip">Assignment 1</a>
				<a href="Assignments/Assignment2Proj.zip">Assignment 2</a>
				<a href="Assignments/Assignment3Proj.zip">Assignment 3</a>
				<a href="Assignments/Assignment4Proj.zip">Assignment 4</a>
				<a href="Assignments/Assignment5Proj.zip">Assignment 5</a>
			</div>
      </div>
      </div>
      </td>
    </tr>
<tr>
<td>

    <?php
        // build SELECT query
        $query = "SELECT * FROM Subscribers";
        
        // Connect to MySQL
        if ( !( $database = mysqli_connect( "localhost",  
            "bonnie", "bon" ) ) )
            die( "<p>Could not connect to database</p></body></html>" );
   
        // open MailingList database
        if ( !mysqli_select_db($database, "MailingList" ) )
            die( "<p>Could not open MailingList database</p>
               </body></html>" );

        // query MailingList database
        if ( !( $result = mysqli_query( $database, $query ) ) ) 
        {
            print( "<p>Could not execute query!</p>" );
            die( mysqli_error() . "</body></html>" );
        } // end if
    ?>
    <h1>Mailing List Subscribers</h1>
    <table style="margin:auto;">
        <caption>Subscribers stored in the database</caption>
        <tr> <!--column headers -->
            <th>ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>E-mail Address</th>
            <th>Phone Number</th>
            <th>Mailing List</th>
        </tr>
        <?php
            // fetch each record in result set
            for ( $counter = 0; $row = mysqli_fetch_row( $result ); ++$counter ) {
               // build table to display results
				print( "<tr>" );
				foreach ( $row as $key => $value ) 
					print( "<td>$value</td>" );
				print( "</tr>" );
            }

            mysqli_close( $database );
        ?>
    </table>
	</td>
	</tr>
	  </tbody>
</table>
</body>
</html>
