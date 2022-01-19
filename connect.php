<?php

$servername="localhost";
$username="root";
$password="";

$database="collegedb";

$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("Sorry :".mysqli_connect_error());
}
?>