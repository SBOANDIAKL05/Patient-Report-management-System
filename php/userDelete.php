<?php


    $id = $_POST['id'];
    $tbl = $_POST['tbl'];

    include("./conn.php");
    $sql1 ="Select * from doctor where Id= $id" ;
    $result1 = mysqli_query($conn,$sql1) or die("Query Failed");
    while($row1=mysqli_fetch_assoc($result1))
              {
                $sql2 ="Delete from doctor where Id= $id" ;
                $result2 = mysqli_query($conn,$sql2) or die("Query Failed");
              }

    $sql ="Update $tbl set ishidden =1 where Id= $id" ;
    $result = mysqli_query($conn,$sql) or die("Query Failed");
    if($result)
    {

      echo "<meta http-equiv='refresh' content='0'>";
    }
?>