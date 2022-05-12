
<form class="mx-auto w-50" method="POST" action="">
  <div class="mb-3">
  <h1>Report</h1>
  
  <h3>Patient Details</h3>
  <div id="printableArea">
  <table class="table table-bordered border border-info border-3 ">

  <!-- ---------------------------------------------Select 2 ko link--------------------------------------------- -->
  <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- ---------------------------------------------Select 2 ko link--------------------------------------------- -->
  
<!-- Php -->
    <?php
    
    if(isset($_GET['id']))
    {
      $id=$_GET['id'];
    }
    
    else $id=1;
    $speciaity ="";
    $uid = $_SESSION["User_ID"];
      $did = $_SESSION["User_ID"];
      $sql ="SELECT report.Id, report.reason, report.referedTo, patient.name, patient.age, patient.address,patient.Weight, patient.phoneNumber, patient.Height, patient.BloodGroup, patient.gender FROM report
      Join patient on report.patient_Id = patient.Id
      where report.Id='$id'" ;

      
       $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));


    
           while($row=mysqli_fetch_assoc($result))
           {
            

            echo '
            
            <tr>
      <th colspan="2" scope="row" class="text-center table-primary border border-info border-3">Medical Report</th>
    </tr>
    <tr style="display: none;">
      <td><input type="text" name="id" value="'.$row["Id"].'">';
      $id = $row["Id"];
      echo '
      
       
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
    <td colspan="2" class="py-3">Doctor\'s Name: ';
    if($_SESSION["UserType"] == "Doctor"){
      echo $_SESSION["name"];
    }
    echo '</td>
    </tr>
          
    <tr class="table-danger border border-info border-3">
    ';
      echo '<td colspan="2" class="py-3">Refered to:
                        <select id="f" name ="category" class="form-select" required>';
                        ?>
                        <?php
                        $sql3="SELECT DISTINCT Specialty FROM doctor";
                        $result3 = mysqli_query($conn, $sql3)  or die(mysqli_error($conn));
                        while($row3=mysqli_fetch_assoc($result3))
                            {
                              echo '<option value="'.$row3["Specialty"].'" id="'.$row3["Specialty"].'"';
                              if($row3["Specialty"] == $row["referedTo"])
                              {
                                  echo 'selected';
                              }
                              echo '>'.$row3["Specialty"].'</option>';
                            }
              
              
                        ?>
                        </select>
    <?php
    
    echo '
    
    
    
    </td>
    </tr>
    <tr>
    <div id="msgbox" class="form-group" style="display: none;">
    <td colspan="2" class="py-3">Reason for medical assessment:';

      echo '<input type="text" name="reason" class="form-control" value="'.$row["reason"].'" required>';

    
  
       
       echo '
       
    </td>
    </tr>
</div>

    '; 
            }
    ?>
    
    
    
  </table>
  
  
  </div>
  <button type="submit" class="btn btn-primary ms-auto" id="click" name="done">Update</button>
  </form>

  <?php
      if(isset($_POST["done"]))
      {
        
        $reason = $_POST["reason"];
        $category = $_POST["category"];
        $id = $_GET["id"];

       
          $sql ="UPDATE report set reason='$reason',referedTo='$category' where Id='$id'";
          $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
          if($result)
          {
            echo '<script>
                alert("Success");
            
            </script>';
            echo "<meta http-equiv='refresh' content='0'>";
                
          
          }
          else
          {
            echo '<script>
            alert("failed");
            
            </script>';
          }
        }
        
    
    ?>


  

  




