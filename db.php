<?php

$host="localhost";
$user="root";
$password="";
$db="smartclinic";

$conn=mysqli_connect($host,$user,$password,$db);

if(!$conn){
die("Database connection failed");
}

?>