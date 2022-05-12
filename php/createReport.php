
<form class="mx-auto w-50" method="POST" action="">
  <div class="mb-3">
  <h1>Report:</h1>
  
  <div id="printableArea">
  <table class="table table-bordered border border-info border-3 ">

  <!-- ---------------------------------------------Select 2 ko link--------------------------------------------- -->
  <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- ---------------------------------------------Select 2 ko link--------------------------------------------- -->
  
<!-- Php -->
    <?php
    
    if(isset($_POST['id']))
    {
      $id=$_POST['id'];
    }
    
    else $id=1;
    $uid = $_SESSION["User_ID"];
      $sql = "Select * from patient where id='$id'";
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
    <td colspan="2" class="py-3">Doctor\'s Name: ' .$_SESSION["name"].'</td>
    </tr>
          
    <tr class="table-danger border border-info border-3">
    ';
    if($_SESSION['UserType'] == "Doctor"){
      echo '<td colspan="2" class="py-3">Specialty:';
      ?>

      <input type="text" name="category" class="form-control" value="<?php
      $doc ="SELECT * FROM doctor where Id='$uid'";
       $docr = mysqli_query($conn,$doc) or die(mysqli_error($conn));


    
           while($rowr=mysqli_fetch_assoc($docr))
           {
             echo $rowr["Specialty"];
           }
    echo '" disabled>';
    }
    echo '
    
    </td>
    </tr>
    <tr>
    <div id="msgbox" class="form-group" style="display: none;">
    <td colspan="2" class="py-3">Reason for medical assessment:';
      ?>

    <input type="text" name="reason" onchange="this.setAttribute('value', this.value)"  class="form-control" value="" required>
    </td>
    </tr>
</div>
<?php
    if($_SESSION['UserType'] == "Doctor"){
      echo '
    <tr class="table-danger border border-info border-3">
    <td colspan="2" class="py-3">Eximination and findings: 
    <select name="disease" class="form-select multiple-select" multiple aria-label="multiple select example" required>'.
        $sql1 ="SELECT * FROM disease";
         $result1 = mysqli_query($conn,$sql1) or die("Query Failed");
             while($row1=mysqli_fetch_assoc($result1))
             {
              echo '<option value="'.$row1["Id"].'">'.$row1["name"].'</option>';
  
             }

     echo '
    [Result of patient\'s health assessments]</td>
    </tr>

    <tr>
    <td colspan="2" class="py-3">Medicines reffered:
    <select name="drugs[]" class="form-select multiple-select1" multiple aria-label="multiple select example" required>'.
        $sql1 ="SELECT * FROM drug";
         $result1 = mysqli_query($conn,$sql1) or die("Query Failed");
             while($row1=mysqli_fetch_assoc($result1))
             {
              echo '<option value="'.$row1["Id"].'">'.$row1["name"].'</option>';
  
             }

     echo '</td>
    </tr>

    <tr class="table-danger border border-info border-3">
    <div id="msgbox" class="form-group">
    <td colspan="2" class="py-3">Feedback:';
    ?>
      <input type="text" name="feedback" onchange="this.setAttribute('value', this.value)"  class="form-control" value ="">
       
    </td>
    </tr>


    <tr >
      <?php echo '
    
    <td colspan="2" class="py-3">Date:'.date('Y-m-d H:i:s').'</td>
    </tr>
    ';
            }
          
          
           }
        
   
          //  <td colspan="2" class="py-3">Signature: _________________________________________[Signature of the person who has prepared the report]</td>
          //  </tr>
       
          //  <tr class="table-danger border border-info border-3"> 
          


    ?>
    
    
  </table>
          </div>

  
  
  <button type="submit" class="btn btn-primary ms-auto" id="click"  name="done">Submit</button>
  <input type="button" class="btn btn-success" onclick="printDiv('printableArea')" value="print" />
  </form>

  <style>
        .form-select{
            width: 100%;
        }
    </style>

    <?php
      if(isset($_POST["done"]))
      {
        $feedback = "";
        
        $reason = $_POST["reason"];
        $id = $_POST["id"];
        $did = $_SESSION["User_ID"];
        $disease = $_POST["disease"];
        $feedback = $_POST["feedback"];
        $category = "";
        $drugs = $_POST["drugs"];
        $drugs1 = implode(', ', $drugs);
            
        $doc ="SELECT * FROM doctor where Id='$uid'";
       $docr = mysqli_query($conn,$doc) or die(mysqli_error($conn));


    
           while($rowr=mysqli_fetch_assoc($docr))
           {
             $category= $rowr["Specialty"];
           }
        $sql="INSERT INTO report(user_Id,Patient_Id,reason, referedTo, disease,drugs, doctor_id, feedback,isFilled  ) VALUES('$uid','$id','$reason','$category','$disease','$drugs1', '$did','$feedback', '1' )";
        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
          if($result)
          {
              echo '<script>
              alert("Success");
              window.location = "./main.php";
              </script>';
          
          }
          else
          {
            echo '<script>
            failed();
            
            </script>';
          }
        }
        
    
    ?>
    


<script>
          $(".multiple-select").select2({
            maximumSelectionLength: 1
          });
          $(".multiple-select1").select2({
            //maximumSelectionLength: 2
          });

          function printDiv(divName) {
            var pagebutton= document.getElementById("click");
          pagebutton.click();
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;

          document.body.innerHTML = printContents;

          window.print();

          document.body.innerHTML = originalContents;
          
     
          }
  </script>


  

  




