<!DOCTYPE html>

<html>
<head>
	<title>Mailing List Form</title>
	<style type = "text/css">
        p       { margin: 0px; }
        .error  { color: red }
        p.head  { font-weight: bold; margin-top: 10px; }
        label   { width: 5em; float: left; }
    </style>
</head>
<body>
	<?php 

//variables
	// set up user-entered variables
	$fName = isset($_POST[ "fName" ]) ? $_POST[ "fName" ] : "";
    $lName = isset($_POST[ "lName" ]) ? $_POST[ "lName" ] : "";
    $email = isset($_POST[ "email" ]) ? $_POST[ "email" ] : "";
    $phone = isset($_POST[ "phone" ]) ? $_POST[ "phone" ] : "";
    $list = isset($_POST[ "list" ]) ? $_POST[ "list" ] : "";
	
	// set up form variables
	$isError = false;
	$inputList = array( "fName" => "First Name",
			"lName" => "Last Name", "email" => "Email",
            "phone" => "Phone" );
	$mailPrefList = array( "Weekly Specials", "Promotionals" );
	$formErrors = array( "fNameError" => false, "lNameError" => false, 
			"emailError" => false, "phoneError" => false );
	
	//if submit button is pressed, set up $formerrors
	if(isset($_POST["submit"])) { //this if includes the entire next section
            if( $fName == "" ){
				$formErrors[ "fNameError" ] = true;
				$isError = true;                   
            }
			if( $lName == "" ){
				$formErrors[ "lNameError" ] = true;
				$isError = true;
            }
			if( $email == "" ){
				$formErrors[ "emailError" ] = true;
				$isError = true;
            }
			if(!preg_match( "/^\([0-9]{3}\) [0-9]{3}-[0-9]{4}$/", $phone )){
				$formErrors[ "phoneError" ] = true;
				$isError = true;
            }
	

//setting up entering user information into database
	//entering into database
	if(!$isError) {
            // Connect to MySQL
            if(!($database = mysqli_connect("localhost", "bonnie", "bon", "MailingList"))){
                die( "<p>Could not connect to database</p>" );
			}
			//build INSERT query
            $query = "INSERT INTO Subscribers " ."( LastName, FirstName, Email, Phone, MailList ) " .
				"VALUES ( '$lName', '$fName', '$email', '" . 
				mysqli_real_escape_string($database, $phone) . "', '$list')";
			// open MailingList database
            if(!mysqli_select_db( $database, "MailingList")) {
				die( "<p>Could not open MailingList database</p>" );
			}
			// execute query in MailingList database
            if(!($result = mysqli_query($database, $query))) {
				print( "<p>Could not execute query!</p>");
				die( mysqli_error() );
			}
			
			//closing database
            mysqli_close( $database );
            
			//printing out results
			print("<p>Hi $fName. Thank you for completing the survey.
                You have been added to the $list mailing list.</p>
                <p class = 'head'>The following information has been 
                    saved in our database:</p>
                <p>Name: $fName $lName</p>
                <p>Email: $email</p>
                <p>Phone: $phone</p>
                <p><a href = 'MailingFormDatabase.php'>Click here to view entire database.</a></p>
                </body></html>" );
            die(); // finish the page
    }
	}
	
//setting up form (logically, can only get here if submit button not pressed or there is an error)
	//setting up Contact Information section
	print("
	<h1>Please enter your information to join the mailing list.</h1>
	<form method='post' action='MailingListForm.php'>
		<h2>Contact Information</h2>");
		//printing the rows
		foreach($inputList as $inputName => $inputAlt) {
			print("<div><label>$inputAlt:</label><input type='text' name='$inputName' 
			value='" . $$inputName . "'>");
			if ( $formErrors[ ( $inputName )."Error" ] == true ) 
				print( "<span class = 'error'>*</span>" );        
            print( "</div>" ); //ending each line
		} 
		//phone error
		if ( $formErrors[ "phoneError" ] ) 
            print( "<p class = 'error'>Must be in the form (555) 555-5555" );
	//end Contact Information
	
	//setting up mailing list section
	print("
	<h2>Mailing List Selection</h2>
	<p>Please indicate which mailing lists you are interested in subscribing to.</p>
	<select name= 'list' >");
	foreach($mailPrefList as $currPref) {
		print( "<option" . 
               ($currPref == $list ? " selected>" : ">") .
               $currPref . "</option>" );
	}
	print("</select><div>");
	
	//submit button
	print("
	<p class='head'><input type='submit' name='submit' value='submit'></p>
	</form>
</body>
</html>");
	?>





