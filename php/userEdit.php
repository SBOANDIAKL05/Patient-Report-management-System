
<div class="container mt-5 w-50 pt-5"> 
    
    <form method="POST" action="">

  <!-- Php -->

    <?php
    $id = $_SESSION["User_ID"];
    $user = "User";
    if(isset($_POST['id']))
    {
        $_SESSION["aid"] = $_POST['id'];
        $id = $_SESSION["aid"];
        $user = "Admin";
    }
    if(isset($_SESSION["aid"])){
        $id = $_SESSION["aid"];
        $user = "Admin";
    }
        $sql ="SELECT * FROM users WHERE ID='{$id}'";
        $result = mysqli_query($conn,$sql) or die("Query Failed");
        
            while($row=mysqli_fetch_assoc($result))
            {
                    
                    
                
                    echo '
                    <h2 class="pb-3">Edit Profile</h2>
    
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
        
                    <div class="form-group">
                    <label for="exampleInputEmail1">Date of Birth</label>
                    <input type="date" name="dateofbirth" class="form-control" id="d" disabled value="'.$row["DOB"].'" placeholder="Date of Birth">
                  </div>
        
                    <div class="form-group">
                        <label for="exampleInputEmail1">Field</label>
                        <select id="e" name ="option" class="form-select" disabled>
                            <option id="User" value="User">User</option>
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
                            <option id="User" value="User">Anesthesiologist</option>
                            <option id="User" value="User">Cardiologist</option>
                            <option id="Doctor" value="Doctor">Dermatologist</option>
                            <option id="Admin" value="Admin">Endocrinologist</option>
                            <option id="User" value="User">Family Physician</option>
                            <option id="User" value="User">Gastroenterologist</option>
                            <option id="Doctor" value="Doctor">Internal Medicine Physician</option>
                            <option id="Doctor" value="Doctor">Infectious Disease Physician</option>
                            <option id="Admin" value="Admin">Nephrologist</option>
                            <option id="User" value="User">Neurologist</option>
                            <option id="User" value="User">Obstetrician/Gynecologist</option>
                            <option id="User" value="User">Oncologist</option>
                            <option id="User" value="User">Ophthalmologist/Gynecologist</option>
                            <option id="Doctor" value="Doctor">Otolaryngologist</option>
                            <option id="Admin" value="Admin">Pediatrician</option>
                            <option id="Doctor" value="Doctor">Physician Executive</option>
                            <option id="Admin" value="Admin">Psychiatrist</option>
                            <option id="Admin" value="Admin">Pulmonologist</option>
                            <option id="Admin" value="Admin">Radiologist</option>
                            <option id="Doctor" value="Doctor">Surgeon</option>
                        </select>
                    </div>
                    
                    </div>
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
                            <input name="name" type="password" class="form-control" value=' . $row["password"] . ' disabled id="h" placeholder="Password">
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
            if($user == "Admin"){
                echo '<script>
                document.getElementById("d").disabled = false;
                document.getElementById("e").disabled = false;
                document.getElementById("f").disabled = false;
            </script>';
            }
        }
        if (isset($_POST['save'])) {

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

            $sql ="UPDATE users SET name = '$name', email ='$email', phoneNumber= '$phoneNumber' WHERE Id='$id'" ;
            if($user == "Admin"){
                $dateofbirth=$_POST['dateofbirth'];
                $userType=$_POST['option'];
                $sql ="UPDATE users SET name = '$name', email ='$email', phoneNumber= '$phoneNumber', DOB= '$dateofbirth', userType= '$userType' WHERE Id='$id'" ;
            }
            $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

            if($result){
                echo ' <Script>
                alert("Profile Created");
                </script>';
                echo "<meta http-equiv='refresh' content='0'>";

            }
            


        }

    ?>
