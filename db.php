<?php

$server='localhost';
$user='root';
$pass='';
$db='crud';

$conn=new mysqli($server,$user,$pass,$db);
if(!$conn){
    die("Database Connection Failed. ".mysqli_connect_error());
}
