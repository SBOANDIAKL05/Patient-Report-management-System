
<div class="container mt-5 w-50 pt-5"> 
    
    <form method="POST" action="">

  <!-- Php -->

    <?php
    $user = $_SESSION["UserType"];
    
    //$check = "";
    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
    }
    else{
        $id = 0;
    }
        $sql ="SELECT * FROM users WHERE ID='{$id}'";
        $result = mysqli_query($conn,$sql) or die("Query Failed");
        
            while($row=mysqli_fetch_assoc($result))
            {
                
                    
                    
                
                    echo '
                    <h2 class="pb-3">Edit Profile</h2>
    
                    <div class="form-row">
        
                    <div class="form-group">
                    <input name="id" value=' . $id . ' disabled style="display:none;">
        
                        <label for="firstName">Full Name</label>
                        <input name="name" type="text" class="dis form-control" id="a" value=' . $row["name"] . ' disabled id="firstName" placeholder="First name">
        
                    </div>
        
                    <div class="form-group ">
        
                    <label for="email">Email</label>
                    <input name="email" type="text" class="dis form-control" id="b" value=' . $row["email"] . ' disabled id="email" placeholder="Email">
        
                    </div>
                    
                    <div class="form-group">
        
                    <label for="phoneNumber">Phone Number</label>
                    <input name="phoneNumber" type="text" minlength="10" class="dis form-control" id="c" value=' . $row["phoneNumber"] . ' disabled id="phoneNumber" placeholder="Phone Number">
        
                    </div>
                
                    <div class="form-row ">
        
                    <div class="form-group">
                    <label for="exampleInputEmail1">Date of Birth</label>
                    <input type="date" name="dateofbirth" class="form-control" id="d" disabled value="'.$row["DOB"].'" placeholder="Date of Birth">
                  </div>
        
                    <div class="form-group">
                        <label for="exampleInputEmail1">Field</label>
                        <select id="e" name ="option" class="form-select" disabled>
                            <option id="User" value="User">Staff</option>
                            <option id="Doctor" value="Doctor">Doctor</option>
                            <option id="Admin" value="Admin">Admin</option>
                        </select>
                    </div>

                    <div id="msgbox"';
                    if(!($row["userType"] == "Doctor")){
                        echo 'style="display:none">';
                    } 
                    echo '
                    <div class="form-group">
                        <label for="exampleInputEmail1">Specialty</label>
                        <select id="f" name ="doc" class="form-select" disabled>
                            <option value="Anesthesiologist" id="Anesthesiologist" >Anesthesiologist</option>
                            <option value="Cardiologist" id="Cardiologist" >Cardiologist</option>
                            <option value="Dermatologist" id="Dermatologist" >Dermatologist</option>
                            <option value="Endocrinologist" id="Endocrinologist" >Endocrinologist</option>
                            <option value="Family Physician" id="Family Physician" >Family Physician</option>
                            <option value="Gastroenterologist"id="Gastroenterologist">Gastroenterologist</option>
                            <option value="Internal Medicine Physician" id="Internal Medicine Physician">Internal Medicine Physician</option>
                            <option value="Infectious Disease Physician" id="Infectious Disease Physician">Infectious Disease Physician</option>
                            <option value="Nephrologist" id="Nephrologist">Nephrologist</option>
                            <option value="Neurologist" id="Neurologist">Neurologist</option>
                            <option value="Obstetrician/Gynecologist" id="Obstetrician/Gynecologist" >Obstetrician/Gynecologist</option>
                            <option value="Oncologist" id="Oncologist" >Oncologist</option>
                            <option value="Ophthalmologist/Gynecologist" id="Ophthalmologist/Gynecologist">Ophthalmologist/Gynecologist</option>
                            <option value="Otolaryngologist" id="Otolaryngologist">Otolaryngologist</option>
                            <option value="Pediatrician" id="Pediatrician">Pediatrician</option>
                            <option value="Physician Executive" id="Physician Executive">Physician Executive</option>
                            <option value="Psychiatrist" id="Psychiatrist" >Psychiatrist</option>
                            <option value="Pulmonologist" id="Pulmonologist">Pulmonologist</option>
                            <option value="Radiologist" id="Radiologist">Radiologist</option>
                            <option value="Surgeon" id="Surgeon">Surgeon</option>
                        </select>
                    </div>
                    
                    </div>
                    ';?>
                    <?php
                    $doc = "Select doctor.Specialty from doctor join users on users.Id = doctor.Id where doctor.Id = '$id'";
                    $res = mysqli_query($conn, $doc); 
                    if(mysqli_num_rows($res)>0)
                    {
                        while($ro=mysqli_fetch_assoc($res))
                        {
                            $sid = $ro['Specialty'];
                            echo '
                            <script>
                                        document.getElementById("'.$sid.'").selected = true;
                                        
                            </script>';
                        }
                    }
                    
                    echo '
                    <script>
                                document.getElementById("'.$row["userType"].'").selected = true;
                                
                        </script>
                        <div class="form-check" id="spwd" style="display:none">
                        <input class="form-check-input" name="c1" type="checkbox" value="epass" id="g">
                        <label class="form-check-label" for="flexCheckDefault">
                            Edit Password
                        </label>
                        </div>

                        <div class="form-group pb-3">
                            <div id="pwd" class="row" style="display:none">
                            <div class="col-11">
                            <input name="password" type="password" class="form-control" value=' . $row["password"] . ' disabled id="h" placeholder="Password">
                            </div>

                            
                            <div class="col-1">
                                <input type="button" value="Show" onclick="selectFunction()" class="btn btn-danger" id="showPassword">
                            </div>
                            </div>
                        </div>
                            
        
                    </div>
                    
                    <button type="submit" class="btn btn-outline-primary" >Cancel</button>
                    <button type="submit" class="btn btn-primary" id="edit" name="edit">Edit</button>
                ';
                }
                
    ?>

   
    <script>
        // Show/ hide password
        
            

        var selectFunction = function() 
        {
            let a = document.getElementById("showPassword").value;
            if (a == "Show") {
                $('#h').attr('type','text');
                document.getElementById("showPassword").value = "Hide";
            }
            
             if(a == "Hide"){
                $('#h').attr('type','Password');
                document.getElementById("showPassword").value = "Show";
            }

        };


        

    //Dropdown
        $(document).ready(function(){
            $('#e').on('change', function() {
            if ( this.value == 'Doctor')
            {
                $("#msgbox").show();
            }
            else
            {
                $("#msgbox").hide();
            }
            });

            $('#g').on('change', function() {
            if($(this).prop("checked")) {
                $("#pwd").show();
            } else {
                $("#pwd").hide();
            }
        });

        //Show hide password

         
        

        });
    
    </script>
    <!-- <style>
    .mycustom {
        position: relative;
    }
    .mycustom input[type=text] {
        border: none;
        width: 100%;
        padding-right: 123px;
    }
    .mycustom .input-group-prepend {
        position: absolute;
        right: 4px;
        top: 4px;
        bottom: 4px;z-index:9;
    }





</style> -->
            

    
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
                document.getElementById("spwd").style.display = "block";
                document.getElementById("h").disabled = false;

            </script>';
            // if($user == "Admin" && $check !="Admin"){
            //     echo '<script>
            //     document.getElementById("spwd").style.display = "none";
            //     </script>';

            // }
            

            if($user == "Admin"){
                echo '<script>
                document.getElementById("d").disabled = false;
                document.getElementById("e").disabled = false;
                document.getElementById("f").disabled = false;
            </script>';
            }
        }
        if (isset($_POST['save'])) 
        {

            echo '<script>
            
            document.getElementById("edit").innerHTML = "Edit";
                document.getElementById("edit").setAttribute("name","edit");
                document.getElementById("a").disabled = true;
                document.getElementById("b").disabled = true;
                document.getElementById("c").disabled = true;
                

            
            </script>';

            //Php for storing altered data

            $name=$_POST['name'];
            $email=$_POST['email'];
            $phoneNumber=$_POST['phoneNumber'];
            $password = $_POST['password'];

            
            


            $result = mysqli_query($conn, "SELECT * FROM pending WHERE id='$id'");
            $num_rows = mysqli_num_rows($result);
            if ($num_rows) 
            {
                echo ' <Script>
                    alert("Previous edit still pending, Try again later.");
                    </script>';
                    echo "<meta http-equiv='refresh' content='0'>";
            
            }
            else{
                    $sql ="INSERT into pending(id, name, email, phoneNumber, password) VALUES('$id', '$name', '$email','$phoneNumber','$password')";
                
                if($user == "Admin")
                {
                    $category = $_POST['doc'];
                    $userType=$_POST['option'];
                    $dateofbirth=$_POST['dateofbirth'];
                    $password= $_POST['password'];
                    // -------------------new doc add, old doc edit-------------------------------------------

                   
                     // -------------------new doc add, old doc edit-------------------------------------------
                    $sql ="UPDATE users SET name = '$name', email ='$email', phoneNumber= '$phoneNumber', DOB= '$dateofbirth', userType= '$userType', password = '$password' WHERE Id='$id'" ;
                    
                }
                $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    
                if($result){
                    
                    if($user == "Admin")
                    {
                        $searchDoc = "Select * from doctor where Id='$id'";
                        $resDoc = mysqli_query($conn,$searchDoc) or die(mysqli_error($conn));
                        if(mysqli_num_rows($resDoc)>0)
                        {
                            while($rowDoc=mysqli_fetch_assoc($resDoc))
                            {
                                
                                if($userType=="Doctor")
                                {
                                    $docr ="UPDATE doctor SET Specialty = '$category' WHERE Id='$id'" ;
                                }
                                else{
                                    $docr ="DELETE from doctor WHERE Id='$id'";
                                }
                               
                                $result = mysqli_query($conn,$docr) or die(mysqli_error($conn));
                                if($result)
                                {
                                    if($resDoc){
                                        echo ' <Script>
                                        alert("Profile updated");
                                        </script>';
                                        echo "<meta http-equiv='refresh' content='0'>";
                                    }
                                }
                            }
                        }
                        else
                        {
                            $docr ="Insert into doctor(Id, Specialty) values('$id','$category')";
                            $resultDoc = mysqli_query($conn,$docr) or die(mysqli_error($conn));
                            if($resDoc){
                                echo ' <Script>
                                alert("Profile updated");
                                </script>';
                                echo "<meta http-equiv='refresh' content='0'>";
                            }
                        }  
                    }
                    else
                    {
                        echo ' <Script>
                        alert("Profile Edit requested!");
                        </script>';
                        echo "<meta http-equiv='refresh' content='0'>";
    
                    }
    
                }

            }
        }
    
    ?>
