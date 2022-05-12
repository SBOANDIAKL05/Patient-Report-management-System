<?php


    $id = $_POST['id'];
    $tbl = $_POST['tbl'];

    include("./conn.php");

    $sql ="Delete FROM $tbl where Id= $id" ;
    $result = mysqli_query($conn,$sql) or die("Query Failed");
    if($result)
    {
      echo "<meta http-equiv='refresh' content='0'>";
    }
?>