<?php

$host="sql203.unaux.com";
$user="unaux_29552604";
$password="wat4t6it1";
$dbname="unaux_29552604_prms";
$conn=mysqli_connect($host,$user,$password,$dbname);
if(!$conn)
{
    die("Could not connect: ".mysqli_connect_error());
}
?>