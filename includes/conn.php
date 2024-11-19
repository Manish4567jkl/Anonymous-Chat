<?php

$servername="localhost";
$username="root";
$password="";
$db="anon";

$con=mysqli_connect($servername,$username,$password,$db);

if(!$con){
    echo "Connection Failed !";
} else {
    // echo "Connection Successful !";
}
?>