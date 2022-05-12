<?php

    include("./conn.php");
        $date = date('Y-m-d');
        echo $date;
        $sql1 ="Delete FROM report where isFilled = 0" ;
        $result1 = mysqli_query($conn,$sql1) or die("Query Failed");
        if($result1){
           

                    echo "<meta http-equiv='refresh' content='0'>";
        }
    

    

    
?>