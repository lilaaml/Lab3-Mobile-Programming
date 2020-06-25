<?php
//these are the server details
//the username is root by default in case of xampp
//password is nothing by default
//and lastly we have the database named android. if your database name is different you have to change it 
$servername = "localhost";
$username = "root";
$password = "";
$database = "products";
 
 
//creating a new connection object using mysqli 
$conn = new mysqli($servername, $username, $password, $database);
 
//if there is some error connecting to the database
//with die we will stop the further execution by displaying a message causing the error 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
//if everything is fine
 
//creating an array for storing the data 
$itemList = array(); 
 
//this is our sql query 
$query = "SELECT * FROM items;";
 
//creating an statment with the query
$statement = $conn->prepare($query);
 
//executing that statment
$statement->execute();
 
//binding results for that statment 
$statement->bind_result($id, $name, $price);
 
//looping through all the records
while($statement->fetch()){
	
	//pushing fetched data in an array 
	$temp = [
        'id' => $id,
        'name' => $name,
        'price' => $price
	];
	
	//pushing the array inside the array 
	array_push($itemList, $temp);
}

//displaying the data in json format 
echo json_encode($itemList);