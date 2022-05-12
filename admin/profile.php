
<div class="container mt-5 w-50 pt-5"> 
  
  <h2 class="pb-3">My Profile</h2>
  
  <form method="POST" action="">
  <!-- Php -->
  <?php
    $id=$_SESSION["User_ID"];

    $conn=mysqli_connect("localhost","root","","PRMS");
    if(!$conn)
    {
        die("Could not connect: ".mysqli_connect_error());
    }
       $sql ="SELECT * FROM users WHERE user_ID='{$id}'";
       $result = mysqli_query($conn,$sql) or die("Query Failed");


    
           while($row=mysqli_fetch_assoc($result))
           {
               echo '

            <div class="form-row">

            <div class="form-group">

                <label for="firstName">Full Name</label>
                <input name="name" type="text" class="dis form-control" id="a" value=' . $row["name"] . ' disabled id="firstName" placeholder="First name">

            </div>

            <div class="form-group ">

            <label for="email">Email</label>
            <input name="email" type="text" class="dis form-control" id="b" value=' . $row["email"] . ' disabled id="email" placeholder="Email">

            </div>
            
            <div class="form-group">

            <label for="phoneNumber">Phone Number</label>
            <input name="phoneNumber" type="text" class="dis form-control" id="c" value=' . $row["phoneNumber"] . ' disabled id="phoneNumber" placeholder="Phone Number">

            </div>
        
            <div class="form-row ">

            <div class="form-group ">

                <label for="dateOfBirth">Date Of Birth</label>
                <input name="dateOfBirth" type="text" class="dis form-control" id="d" value=' . $row["DOB"] . ' disabled id="dateOfBirth" placeholder="Date Of Birth">

            </div>

            <div class="form-group pb-3">

                <label for="field">Field</label>
                <input name="field" type="text" class="dis form-control" id="e" disabled id="field" placeholder="field">

            </div>
            ';
           
    }
    ?>
            
        
    

            <button type="submit" class="btn btn-outline-primary" >Cancel</button>
            <button type="submit" class="btn btn-primary" id="edit" name="edit">Edit</button>
            

    
  </form>

</div> 
<?php
        if (isset($_POST['edit'])) {
            

            echo '<script>
            
            document.getElementById("edit").innerHTML = "Save";
                document.getElementById("edit").setAttribute("name","save");
                document.getElementById("a").disabled = false;
                document.getElementById("b").disabled = false;
                document.getElementById("c").disabled = false;
                document.getElementById("d").disabled = false;
                document.getElementById("e").disabled = false;

            
            </script>';
        }
        if (isset($_POST['save'])) {

            echo '<script>
            
            document.getElementById("edit").innerHTML = "Edit";
                document.getElementById("edit").setAttribute("name","edit");
                document.getElementById("a").disabled = true;
                document.getElementById("b").disabled = true;
                document.getElementById("c").disabled = true;
                document.getElementById("d").disabled = true;
                document.getElementById("e").disabled = true;
                

            
            </script>';

            //Php for storing altered data

            $name=$_POST['name'];
            $email=$_POST['email'];
            $phoneNumber=$_POST['phoneNumber'];
            $dateOfBirth=$_POST['dateOfBirth'];
            $field=$_POST['field'];

            $sql ="UPDATE users
            SET name = '$name', email ='$email', phoneNumber= '$phoneNumber', DOB= '$dateOfBirth'
            WHERE user_ID='$id'" ;
            $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

            if($result){
                echo ' <Script>
                alert("Profile updated");
                </script>';
                echo "<meta http-equiv='refresh' content='0'>";

            }
            


        }

    ?>
