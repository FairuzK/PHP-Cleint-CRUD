<?php
include 'db.php';
if(isset($_GET["ID"])){
    $id=$_GET["ID"];
    $sql="DELETE from client where ID=$id";
    $conn->query($sql);
}
header("Location: /Crud/index.php");
exit;

?>