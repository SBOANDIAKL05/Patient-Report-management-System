
<div class="container mt-5 w-50 pt-5"> 
    
    <form method="POST" action="">

  <!-- Php -->

    
                    <h2 class="pb-3">Create New Profile</h2>
    
                    <div class="form-row">
        
                    <div class="form-group">
        
                        <label for="firstName">Full Name</label>
                        <input name="name" type="text" class="dis form-control" id="a" id="firstName" placeholder="First name" required>
        
                    </div>
        
                    <div class="form-group ">
        
                    <label for="email">Email</label>
                    <input name="email" type="text" class="dis form-control" id="b" id="email" placeholder="Email" required>
        
                    </div>
                    
                    <div class="form-group">
        
                    <label for="phoneNumber">Phone Number</label>
                    <input name="phoneNumber" type="text" minlength="10" class="dis form-control" id="c" id="phoneNumber" placeholder="Phone Number" required>
        
                    </div>
                
                    <div class="form-row ">
        
                    <div class="form-group">
                    <label for="exampleInputEmail1">Date of Birth</label>
                    <input type="date" name="dateofbirth" class="form-control" id="d" placeholder="Date of Birth" required>
                  </div>
        
                    <div class="form-group">
                        <label for="exampleInputEmail1">Field</label>
                        <select id="e" name ="option" class="form-select" required>
                            <option id="User" value="User">User</option>
                            <option id="Doctor" value="Doctor">Doctor</option>
                            <option id="Admin" value="Admin">Admin</option>
                        </select>
                    </div>

                    <div id="msgbox" class="form-group" style="display: none;">
                        <label for="exampleInputEmail1">Specialty</label>
                        <select id="f" name ="doc" class="form-select">
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
                            <option value="Psychiatrist" id="Physician Executive" >Psychiatrist</option>
                            <option value="Pulmonologist" id="Pulmonologist">Pulmonologist</option>
                            <option value="Radiologist" id="Radiologist">Radiologist</option>
                            <option value="Surgeon" id="Surgeon">Surgeon</option>
                        </select>
                    </div>
                    
                    </div>

                    <div class="form-group pb-3">
                            <div id="pwd" class="row">
                            <label class="form-check-label" for="flexCheckDefault">Password </label>
                                <div class="col-11">
                                    <input name="password" type="password" class="form-control"id="h" placeholder="Password" required>
                                </div>
                                <div class="col-1">
                                    <input type="button" value="Show" onclick="selectFunction()" class="btn btn-danger" id="showPassword">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <button type="submit" class="btn btn-primary" id="cac" name="cac">Create Account</button>
        
             
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
                document.getElementById("f").required = true;
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
  
            

    
</form>
</div> 

<?php

            //Php for storing altered data

                if(isset($_POST["cac"])){
                $name=$_POST['name'];
                $email=$_POST['email'];
                $phoneNumber=$_POST['phoneNumber'];
                $dateofbirth=$_POST['dateofbirth'];
                $userType=$_POST['option'];
                $password= $_POST['password'];
                $category= $_POST['doc'];

                $sql ="INSERT INTO users(name, email, phoneNumber, DOB, userType, password) VALUES('$name', '$email','$phoneNumber','$dateofbirth','$userType','$password')";
                $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

                if($result){
                    if($userType == "Doctor")
                    {
                        $search = "Select * from users where name='$name' && email ='$email' && phoneNumber='$phoneNumber'";
                        $sea1 = mysqli_query($conn,$search) or die(mysqli_error($conn));
                        if(mysqli_num_rows($sea1)>0)
                        {
                            while($row=mysqli_fetch_assoc($sea1))
                            {
                                $did = $row["Id"];
                                $sql1= "INSERT INTO doctor(Id, Specialty) values('$did', '$category')";
                                $result1 = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
                                if($result1){
                                    echo ' <Script>
                                    alert("Profile Created");
                                    window.location = "./admin.php?PageName=user";
                                    </script>';
                            }
                        }

                        }
                    }
                    else
                    {
                        echo ' <Script>
                        alert("User Created");
                        window.location = "./admin.php?PageName=user";
                        </script>';
                    }
                }
            }  

    ?>
