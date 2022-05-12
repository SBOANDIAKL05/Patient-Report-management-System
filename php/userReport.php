
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
    
    if(isset($_GET['id']))
    {
      $id=$_GET['id'];
    }
    else $id =1;
    
       $sql ="SELECT report.Id, patient.name, patient.age, patient.address, patient.Weight, patient.BloodGroup,report.drugs, patient.phoneNumber,
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
      $doc ="SELECT doctor.Specialty FROM doctor join report on report.Doctor_id=doctor.id where report.Id='$id'";
       $docr = mysqli_query($conn,$doc) or die(mysqli_error($conn));


    
           while($rowr=mysqli_fetch_assoc($docr))
           {
             echo $rowr["Specialty"];
           }
    echo '" disabled>
    
    
    
    </td>
    </tr>
    <tr>
    <div id="msgbox" class="form-group" style="display: none;">
    <td colspan="2" class="py-3">Reason for medical assessment:
      <input type="text" name="reason" class="form-control" disabled value ="'.$row["reason"].'">
       
    </td>
    </tr>
</div>

    ';
      echo '
    <tr class="table-danger border border-info border-3">
    <td colspan="2" class="py-3">Eximination and findings: 
    <select name="disease" class="form-select multiple-select" multiple aria-label="multiple select example" disabled>
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
              <option value="<?php echo $row1["name"];?>"
                <?php 
                
              if($row1["Id"] == $rowr["Disease"])
              echo 'selected';?>
              disabled>
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
    <select name="drugs[]" class="form-select multiple-select1" multiple aria-label="multiple select example" disabled>';
    


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
      <input type="text" name="feedback" class="form-control" value ="'.$row["feedback"].'" disabled>
       
    </td>
    </tr>


    <tr >
    
    <td colspan="2" class="py-3">Date:'.date('Y-m-d H:i:s').'</td>
    </tr>
    ';
            }
    ?>
    
    
  </table>
  </div>
  </form>
  <input type="button" class="btn btn-success" onclick="printDiv('printableArea')" value="print" />
  



<?php 
if($_SESSION["UserType"]=="Doctor")
{
  
  echo '<a href="main.php?PageName=editReport&id='. $id.'" name="edit" class="btn btn-primary ms-auto" id="edit">Edit</a> ';
  //  echo '<form action="main.php?PageName=editReport" method="POST">
  //  <button type="submit" value="'. $id.'" class="btn btn-primary ms-auto"  name="edit">Edit</button>
  //  </form>';
}



  ?>
  
  

  <style>
        .form-select{
            width: 100%;
        }
    </style>

    <?php

    
    ?>
    


<script>
          $(".multiple-select").select2({
            maximumSelectionLength: 1
          });
          $(".multiple-select1").select2({
            //maximumSelectionLength: 2
          });

          function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
  </script>

