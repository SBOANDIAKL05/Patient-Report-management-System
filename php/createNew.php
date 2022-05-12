<?php
$uid = $_SESSION["User_ID"];
?>


<div class="container mt-5 pl-2 w-50">
    <!-- Main Content -->
      <h2 class="pb-3">Create New:</h2>

      <form method="POST" action="">
        <div class="row">
          <div class="col-lg-6 col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Full Name</label>
              <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>
          </div>
          
          <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Address</label>
              <input type="text" name="address" class="form-control" placeholder="Address" required>
            </div>
          </div>

          

          <div class="col-lg-offset-0 col-lg-3 col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="Gender"  class="select">Gender</label>
              <select class="form-control" name="gender" required>
			  	        <option>Others</option> 
                  <option>Male</option>
                  <option>Female</option> 
                </select>
            </div>
          </div>

          <div class="col-lg-offset-0 col-lg-3 col-xs-12 col-sm-12 pb-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Age</label>
                <input type="number" name="age" class="form-control" placeholder="Age" required>
            </div>
          </div>
		  <hr>

		  <!-- Optional------------------------------------------------------------------- -->

		  <h4 class="pt-1 pb-3">Optional:</h4>

		  <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-12">
            <div class="form-group">
              <label  class="select">Height</label>
              <input type="text" name="height" class="form-control" placeholder="Height">
            </div>
          </div>

          <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-12">
            <div class="form-group">
              <label  class="select">Weight</label>
              <input type="text" name="weight" class="form-control" placeholder="Weight">
            </div>
          </div>

          <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-6">
            <div class="form-group">
			<div class="form-group">
              <label for="Gender" class="select">Blood Group</label>
              <select class="form-control" name="bloodgroup">
			  	<option>Other</option> 
			  	<option>O+</option>
                  <option>O-</option> 
                  <option>A+</option>
                  <option>A-</option> 
                  <option>B+</option>
                  <option>B-</option> 
				          <option>AB+</option>
                  <option>AB-</option> 
                </select>
            </div>
            </div>
          </div>

		  

          <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Date of Birth</label>
              <input type="date" name="dateofbirth" class="form-control" placeholder="Date of Birth">
            </div>
          </div>

          <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="Gender" class="select">E-Mail</label>
              <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
          </div> 

		  <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-6 pb-4">
            <div class="form-group">
              <label for="exampleInputEmail1">Phone Number</label>
              <input type="text" minlength="10" name="phonenumber" minlength="10" class="form-control" placeholder="Phone Number">
            </div>
          </div>
			<br>
			<br>
      <hr>
      <div class="col-lg-offset-0 col-lg-12 col-xs-12 col-sm-12 pb-4">
          <div class="form-group">
            <h5 class="pt-1 ">Reason for medical assessment:</h5>
            <input type="text" name="reason" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
          </div>
      </div>
      <div class="pb-3">
        <label for="exampleInputEmail1">Refer to:</label>
        <select id="f" name ="doc" class="form-select" required>
          <?php
          $sql3="SELECT DISTINCT Specialty FROM doctor";
          $result3 = mysqli_query($conn, $sql3)  or die(mysqli_error($conn));
          while($row3=mysqli_fetch_assoc($result3))
              {
                echo '<option value="'.$row3["Specialty"].'" id="'.$row3["Specialty"].'" >'.$row3["Specialty"].'</option>';
              }


          ?>
                            
                            
                        </select>
        </div>

			<button type="submit" class="btn btn-primary w-25 ms-auto" name="submit">Submit</button>
      </form>

    </div> <!-- /Main Content -->
    <br />
    <br />
  </div>
  <hr>
</div>

<?php
if(isset($_POST['submit']))
{

  $name=$_POST['name'];
  $address=$_POST['address'];
	$gender=$_POST['gender'];
   $age=$_POST['age'];
	$bloodgroup=$_POST['bloodgroup'];
	$height=$_POST['height'];
	$weight=$_POST['weight'];
	$dateofbirth=$_POST['dateofbirth'];
	$email=$_POST['email'];
	$phonenumber=$_POST['phonenumber'];
  $reason=$_POST['reason'];
	$category=$_POST['doc'];
  

	
  $sql ="INSERT INTO PATIENT(email, name, age, address, phoneNumber, Height, Weight, BloodGroup, gender, dateOfBirth,registeredBy) VALUES('$email', '$name', '$age', '$address', '$phonenumber', '$height', '$weight', '$bloodgroup', '$gender', '$dateofbirth',$uid);" ;
  $result = mysqli_query($conn, $sql)  or die(mysqli_error($conn));

  if($result)
  {
    $search = "Select * from patient where name='$name' && email='$email' && age='$age' && address='$address'";
    $resultsear = mysqli_query($conn,$search) or die(mysqli_error($conn));
    $pid;
    if(mysqli_num_rows($resultsear)>0)
    {
        while($rowsear=mysqli_fetch_assoc($resultsear))
        {
          $pid= $rowsear['Id'];
        }
      }
        $sql1="INSERT INTO report(user_Id,Patient_Id,reason, referedTo, disease ) VALUES('$uid','$pid','$reason','$category','316')";
        $result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));; 
        if($result1)
        {
          echo '<script>
          alert("Patient Added");
          </script>';
        }
        else
        {
          echo '<script>
          failed();
          
          </script>';
        }
      }
      else
      {
        echo '<script>
        failed();
        
        </script>';
      }
        
      }

?>


	