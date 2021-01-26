<?php
	$inData = getRequestInfo();
	
	$firstName = $inData["firstName"];
	$lastName = $inData["lastName"];
	$phoneNumber = $inData["phoneNumber"];
	$email = $inData["email"];
	$address = $inData["address"];
	$city = $inData["city"];
	$state = $inData["state"];
	$zip = $inData["zip"];
	
	$conn = new mysqli("localhost", "superUser", "superPassword", "Contatti");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		$sql = "INSERT INTO Contacts (c_firstName,c_lastName, c_phoneNumber, c_email, address, city, state, zip) VALUES (" . $firstName . ",'" . $lastName . "'," . $phoneNumber . ", " . $email . ", " . $address . ", " . $state . ", " . $zip . ")";
		if( $result = $conn->query($sql) != TRUE )
		{
			returnWithError( $conn->error );
		}
		$conn->close();
	}
	
	returnWithError("");
	
	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}
	
	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
?>