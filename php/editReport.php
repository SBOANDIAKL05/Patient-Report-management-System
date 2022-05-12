
<form class="mx-auto w-50" method="POST" action="">
  <div class="mb-3">
  <h1>Report:</h1>
  
  <table class="table table-bordered border border-info border-3 ">
    <!-- ---------------------------------------------Select 2 ko link--------------------------------------------- -->
    <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- ---------------------------------------------Select 2 ko link--------------------------------------------- -->
<!-- Php -->
    <?php
    if($_SESSION["UserType"]!="Doctor"){
      header("location:main.php");
    }
    if($_SESSION["UserType"]=="Doctor"){
      $did = $_SESSION["User_ID"];
    }
    else{
      header("location:main.php");
    }
    
    if(isset($_GET['id']))
    {
      $id=$_GET['id'];
    }
    else $id =1;

    
       $sql ="SELECT report.Id, report.drugs, patient.name, patient.age, patient.address, patient.Weight, patient.BloodGroup, patient.phoneNumber,
       patient.Height, patient.gender, users.name as doc, report.feedback, report.reason, report.Disease 
        FROM report
        JOIN patient ON report.Patient_Id=patient.Id
        JOIN users ON report.Doctor_Id = users.Id where report.Id='$id'" ;
       $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
       


    
           while($row=mysqli_fetch_assoc($result))
           {
            

            echo '
            
            <tr>
      <th colspan="2" scope="row" class="text-center table-primary border border-info border-3">Medical Report</th>
    </tr>
    <tr style="display: none;">
      <td><input type="text" name="id" value="'.$row["Id"].'">
       
    </td>
    </tr>

    <tr>
      <td colspan="2" class="py-3">Report prepared for: ' .$row["name"].'</td>
    </tr>
    <tr class="table-danger border border-info border-3">
      <td class="border border-info border-3 py-3">Age: ' .$row["age"].'</td>
      <td class="py-3">Height: ' .$row["Height"].'</td>
    </tr>
    <tr class=" border border-info border-3">
      <td class="border border-info border-3 py-3">Address: ' .$row["address"].'</td>
      <td class="py-3">Gender: ' .$row["gender"].'</td>
    </tr>
    <tr class="table-danger">
      <td class=" border border-info border-3 pt-3">Weight: ' .$row["Weight"].'</td>
      <td class="py-3"> Blood Group: ' .$row["BloodGroup"].'</td>
    </tr>

    <tr class="border border-info border-3">
    <td colspan="2" class="py-3">Contact: ' .$row["phoneNumber"].'</td>
    </tr>
    <tr class="table-primary border border-info border-3">
    <th colspan="2" class="py-2 text-center"> Findings:</th>
    </tr>

    <tr>
    <td colspan="2" class="py-3">Doctor\'s Name: ' .$row["doc"].'</td>
    </tr>
          
    <tr class="table-danger border border-info border-3">
    ';
    

      echo '<td colspan="2" class="py-3">Specialty:
      <input type="text" class="form-control" value="';
      $doc ="SELECT * FROM doctor where id='$did'";
       $docr = mysqli_query($conn,$doc) or die(mysqli_error($conn));
           while($rowr=mysqli_fetch_assoc($docr))
           {
             echo $rowr["Specialty"];
             $category = $rowr["Specialty"];
           }
    echo '">
    
    
    
    </td>
    </tr>
    <tr>
    <div id="msgbox" class="form-group" style="display: none;">
    <td colspan="2" class="py-3">Reason for medical assessment:
      <input type="text" name="reason" class="form-control" value ="'.$row["reason"].'">
       
    </td>
    </tr>
</div>

    ';
      echo '
    <tr class="table-danger border border-info border-3">
    <td colspan="2" class="py-3">Eximination and findings: 
    <select name="disease" class="form-select multiple-select" multiple aria-label="multiple select example">
    ';


    $doc ="SELECT Disease FROM report where id='$id'";
       $docr = mysqli_query($conn,$doc) or die(mysqli_error($conn));
       while($rowr=mysqli_fetch_assoc($docr))
       {
        
        $sql1 ="SELECT * FROM disease";
         $result1 = mysqli_query($conn,$sql1) or die("Query Failed");
             while($row1=mysqli_fetch_assoc($result1))
             {

               ?>
              <option value="<?php echo $row1["Id"];?>"
                <?php 
                
              if($row1["Id"] == $rowr["Disease"])
              echo 'selected';?>
              >
              <?php echo $row1["name"];?>
              </option>;
              <?php
  
             }
             echo $rowr["Disease"];
       }

      
    echo '
    [Result of patient\'s health assessments]</td>
    </tr>

    <tr>
    <td colspan="2" class="py-3">Medicines reffered:
    <select name="drugs[]" class="form-select multiple-select1" multiple aria-label="multiple select example">';
    
    $drug= $row["drugs"];
       $drugs = explode (",", $drug); 
           
            $sql1 ="SELECT * FROM drug";
            $result1 = mysqli_query($conn,$sql1) or die("Query Failed");
             while($row1=mysqli_fetch_assoc($result1))
             {
               ?>
               <option value="<?php echo $row1['Id'];?>"
               <?php
                echo in_array($row1["Id"], $drugs)?'selected':'';
                
                ?>
                >
                <?php echo $row1["name"];?>
                </option>
                <?php

  
             }
            
            

     echo '</td>
    </tr>

    <tr class="table-danger border border-info border-3">
    <div id="msgbox" class="form-group">
    <td colspan="2" class="py-3">Feedback:
      <input type="text" name="feedback" class="form-control" value ="'.$row["feedback"].'">
       
    </td>
    </tr>


    <tr >
    
    <td colspan="2" class="py-3">Date:'.date('Y-m-d H:i:s').'</td>
    </tr>
    ';
            }
    ?>
    
    
  </table>

 
  <button type="submit" class="btn btn-primary ms-auto"  name="submit">Submit</button>
  </form>
  

  <style>
        .form-select{
            width: 100%;
        }
    </style>

<?php
      if(isset($_POST["submit"]))
      {
        
        $reason = $_POST["reason"];
        $id = $_POST["id"];
        $disease = $_POST["disease"];
        $feedback = $_POST["feedback"];
        $drugs = $_POST["drugs"];
          $drugs1 = implode(', ', $drugs);
          $sql ="SET foreign_key_checks = 0;";
          $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
          $sql = "UPDATE report set doctor_id ='$did',disease='$disease',drugs='$drugs1',reason='$reason',feedback='$feedback' where Id='$id'";
          $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
          header("location:main.php?PageName=viewReports&id=$id");
          
        
          if($result)
          {
          
                  echo '<script>
                  alert("Success");
                  window.location.href = "main.php?PageName=userReport&id='.$id.'";
                  </script>';
                  
                  
               
              }
            
              
          }
        
        $sql = "SET foreign_key_checks = 1";
          $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

        
        
      
      
    
    ?>
    


<script>
          $(".multiple-select").select2({
            maximumSelectionLength: 1
          });
          $(".multiple-select1").select2({
            //maximumSelectionLength: 2
          });
  </script>
