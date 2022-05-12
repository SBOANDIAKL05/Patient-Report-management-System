
<?php
    if(isset($_GET['id']))
    {
      $id=$_GET['id'];
    }
    
    else $id=1;
    $uid = $_SESSION["User_ID"];
?>



  <!-- Php -->
             
<div class="container mt-5 pl-2 w-50">
    <!-- Main Content -->
      <h2 class="pb-3">Details:</h2>

      <form method="POST" action="">
      <?php 
    $sql ="SELECT * from patient where Id='$id'";
    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));


    //Edit garnu xa yaaaa tala////////////////////////////////////////////////////////////////
        while($row=mysqli_fetch_assoc($result))
        {

            echo '
        <div class="row">
          <div class="col-lg-6 col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Full Name</label>
              <input type="text" name="name" class="form-control" placeholder="Full Name" value="'.$row["name"].'" required>
            </div>
          </div>
          
          <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Address</label>
              <input type="text" name="address" class="form-control"  value="'.$row["address"].'" placeholder="Address" required>
            </div>
          </div>

          

          <div class="col-lg-offset-0 col-lg-3 col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="Gender"  class="select">Gender</label>
              <select class="form-control" name="gender" required>
			  	        <option>Others</option> 
                  <option ';
                  if($row["gender"] == "Male"){
                    echo 'selected';
                } 
                echo '>Male</option>
                  <option ';
                  if($row["gender"] == "Female"){
                    echo 'selected';
                } 
                echo '>Female</option> 
                </select>
            </div>
          </div>

          <div class="col-lg-offset-0 col-lg-3 col-xs-12 col-sm-12 pb-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Age</label>
                <input type="number" name="age" class="form-control" value="'.$row["age"].'" placeholder="Age" required>
            </div>
          </div>
		  <hr>

		  <!-- Optional------------------------------------------------------------------- -->

		  <h4 class="pt-1 pb-3">Optional:</h4>

		  <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-12">
            <div class="form-group">
              <label  class="select">Height</label>
              <input type="text" name="height" class="form-control" value="'.$row["Height"].'" placeholder="Height">
            </div>
          </div>

          <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-12">
            <div class="form-group">
              <label  class="select">Weight</label>
              <input type="text" name="weight" class="form-control" value="'.$row["Weight"].'" placeholder="Weight">
            </div>
          </div>

          <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-6">
            <div class="form-group">
			<div class="form-group">
              <label for="Gender" class="select">Blood Group</label>
              <select class="form-control" name="bloodgroup">
			  	<option ';if ($row["BloodGroup"] == "Other"){
                    echo 'selected';
                } 
                echo '
                  >Other</option> 
			  	<option ';if ($row["BloodGroup"] == "O+"){
                    echo 'selected';
                } 
                echo '>O+</option>
                  <option ';if ($row["BloodGroup"] == "O-"){
                    echo 'selected';
                } 
                echo '>O-</option> 
                  <option ';if ($row["BloodGroup"] == "A+"){
                    echo 'selected';
                } 
                echo '>A+</option>
                  <option ';if ($row["BloodGroup"] == "A-"){
                    echo 'selected';
                } 
                echo '>A-</option> 
                  <option ';if ($row["BloodGroup"] == "B+"){
                    echo 'selected';
                } 
                echo '>B+</option>
                  <option ';if ($row["BloodGroup"] == "B-"){
                    echo 'selected';
                } 
                echo '>B-</option> 
				    <option ';if ($row["BloodGroup"] == "AB+"){
                    echo 'selected';
                } 
                echo '>AB+</option>
                  <option ';if ($row["BloodGroup"] == "AB-"){
                    echo 'selected';
                } 
                echo '>AB-</option> 
                </select>
            </div>
            </div>
          </div>

		  

          <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Date of Birth</label>
              <input type="date" name="dateofbirth" class="form-control"  value="'.$row["dateOfBirth"].'" placeholder="Date of Birth">
            </div>
          </div>

          <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-6">
            <div class="form-group">
              <label for="Gender" class="select">E-Mail</label>
              <input type="email" name="email" class="form-control" value="'.$row["email"].'" placeholder="Email">
            </div>
          </div> 

		  <div class="col-lg-offset-0 col-lg-6 col-xs-12 col-sm-6 pb-4">
            <div class="form-group">
              <label for="exampleInputEmail1">Phone Number</label>
              <input type="text" minlength="10" name="phonenumber" minlength="10" class="form-control" value="'.$row["phoneNumber"].'" placeholder="Phone Number">
            </div>
          </div>
			<br>
			<br>
      <hr>

			<button type="submit" class="btn btn-primary w-25 ms-auto" name="submit">Edit</button>
            
            ';}

                ?>
      </form>

    </div> <!-- /Main Content -->
    <hr>
    <div class="container ">
    <table id="myTable" class="table mx-auto">
        <?php
        $id=$_GET["id"];
            $sql1 ="SELECT patient.Id, report.referedTo, report.date, report.reason, report.isFilled,report.Id as rid
            FROM report
            JOIN patient ON report.Patient_Id=patient.Id
            JOIN users ON report.user_Id = users.Id
             where patient_Id = '$id'";
             $result1 = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
             echo '<thead class="table-light">
              <tr>
                <th scope="col">Report Id</th>
                <th scope="col">Refered To</th>
                <th scope="col">Reason</th>
                <th scope="col">isChecked</th>
                <th scope="col"><th>
              </tr>
            </thead>
            <tbody>';
            $url = basename($_SERVER['PHP_SELF']);
              while($row1=mysqli_fetch_assoc($result1))
              {
                echo "<tr>";
                echo '<td scope="col">' . $row1["rid"] . '</td>';
                echo '<td scope="col">' . $row1["referedTo"] . '</td>';
                echo '<td scope="col">' . $row1["reason"] . '</td>';
                echo '<td scope="col">';
                if($row1["isFilled"] == "0"){
                    echo 'no';
                }
                else
                {
                    echo 'yes';
                }
                echo '</td>';
                echo '<td scope="col">'; 
                   
                     if($row1["isFilled"] == "0"){
                      echo '<a href="./'.$url.'?PageName=unfilledReport&id='.$row1["rid"] .'" class="btn btn-info btn-sm"';
                    }
                    else{
                      echo '<a href="./'.$url.'?PageName=userReport&id='.$row1["rid"] .'" class="btn btn-info btn-sm"';
                    }
                    echo '>View Report</a>';
                
                
                 
                if($_SESSION["UserType"] == "Admin")
                {
                  echo '
                  <button id="'.$row1['rid'].'" class="delete btn btn-danger btn-sm">Delete</button>
                  ';
                }
                echo '</td></tr>
                ';
              }
             
             
        ?>
        </table>


    </div>
    <br />
    <br />

  <hr>





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
  

	
  $sql ="Update PATIENT set email='$email', name='$name', age='$age', address='$address', phoneNumber='$phonenumber', Height='$height', Weight='$weight', BloodGroup='$bloodgroup', gender='$gender', dateOfBirth='$dateofbirth',registeredBy='$uid' where Id='$id';" ;
  $result = mysqli_query($conn, $sql)  or die(mysqli_error($conn));

  if($result)
  
          echo '<script>
          alert("Success");
          </script>
          ';
          echo "<meta http-equiv='refresh' content='0'>";
          
        
      }


?>

<script> 

$('.delete').click(function(){
  var id=this.id;
            if(confirm("Are you sure?"))
            {
            
              $.ajax({
                          url: "./php/deleteReport.php",
                          method:"POST",
                          data:{id:id, tbl:'patient'},
                          success:function(data)
                          {   
                              location.reload(true);
                              
                          }
              });
            }
        });

        
  </script>


	