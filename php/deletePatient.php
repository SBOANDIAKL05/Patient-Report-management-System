<?php


    $id = $_POST['id'];

    include("./conn.php");
    $sql ="Select * from report where Patient_Id = '$id'" ;
    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    if(mysqli_num_rows($result)>0){

        while($row=mysqli_fetch_assoc($result)){
            $id1= $row["Id"];
                $sql2 ="Delete FROM report where Id= $id1" ;
                $result2 = mysqli_query($conn,$sql2) or die((mysqli_error($conn)));
                    
        }
        $sql3 ="Delete FROM patient where Id= $id" ;
        $result3 = mysqli_query($conn,$sql3) or die((mysqli_error($conn)));
        if($result3)
        {

            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
    else{
        $sql3 ="Delete FROM patient where Id= $id" ;
                    $result3 = mysqli_query($conn,$sql3) or die((mysqli_error($conn)));
                    if($result3)
                    {
    
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
    }
    

    

    
?>