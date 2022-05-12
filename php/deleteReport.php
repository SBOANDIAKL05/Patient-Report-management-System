<?php


    $id = $_POST['id'];

    include("./conn.php");
            $sql2 ="Delete FROM report where Id= $id" ;
            $result2 = mysqli_query($conn,$sql2) or die("Query Failed");
            if($result2)
            {

                    echo "<meta http-equiv='refresh' content='0'>";
                
            }
        
    

    

    
?>