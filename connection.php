<?php
$servername="localhost";
$username="root";
$password="";
$dbname="hmas_db";

//Create connection
$conn=mysqli_connect($servername,$username,$password,$dbname);

//Check connection
if($conn->connect_error){
die("Connnection failed: ".$conn->connect_error);
}


?>