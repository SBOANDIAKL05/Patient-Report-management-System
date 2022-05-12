<div class="input-group mt-5 mx-auto w-50 pb-3">
  <input type="text" class="form-control rounded" id="search" onkeyup="searchFunction()"  placeholder="Enter patient's name" />
  <br>
</div>

<?php
$uid = $_SESSION["User_ID"];
?>


<div class="tableFixHead w-50 mx-auto  mt-4">
<?php
if($_SESSION["UserType"] == "Admin")
{
  echo '<a class="btn btn-primary mx-auto mb-2" href="./admin.php?PageName=createNew" role="button">Create New</a>';
}
?>
  <table id="myTable" class="table mx-auto">
    <thead class="table-light">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Age</th>
        <th scope="col">Gender</th>
        <th scope="col">Registered By</th>
        <th scope="col"><th>
      </tr>
    </thead>
    <tbody>
    <?php
    $date = date('Y-m-d');
    
        $sql ="SELECT report.Id, patient.name, patient.age, users.name as uname, patient.gender FROM report
        Join patient on report.patient_id = patient.Id
        join users on report.user_Id = users.Id
         where report.date='$date' && report.isFilled='0'"
          ;
          if($_SESSION["UserType"] == "Doctor"){
            $dspec = "";
            $doc ="SELECT * FROM doctor where Id='$uid'";
            $docr = mysqli_query($conn,$doc) or die(mysqli_error($conn));
            while($rowr=mysqli_fetch_assoc($docr))
              {
                $dspec = $rowr["Specialty"];
              }

            $sql ="SELECT report.Id, patient.name, patient.age, users.name as uname, patient.gender FROM report
            Join patient on report.patient_id = patient.Id
            join users on report.user_Id = users.Id
            where report.date='$date' && report.isFilled='0' && report.referedTo = '$dspec'"
          ;
          }
        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
        $url = basename($_SERVER['PHP_SELF']);
            while($row=mysqli_fetch_assoc($result))
            {
              echo "<tr>";
              echo '<td scope="col">' . $row["Id"] . '</td>';
               echo '<td scope="col">' . $row["name"] . '</td>';
               echo '<td scope="col">' . $row["age"] . '</td>';
               echo '<td scope="col">' . $row["gender"] . '</td>';
               echo '<td scope="col">' . $row["uname"] . '</td>';
               echo '<td scope="col">'; 
               if($_SESSION['UserType'] == "Doctor"){
                echo '
                <a href="./'.$url.'?PageName=report&id='.$row["Id"] .'" class="btn btn-success btn-sm">New Report</a>
                ';

               }
                 
               
               if($_SESSION["UserType"] == "Admin")
               {
                 echo '<a id='.$row['Id'].' class="delete btn btn-danger btn-sm">Delete</a>
                 ';
               }
               echo '</td></tr>
               </form>';

            //Delete button
            // if (isset($_POST['delete'])) {
            //   $id= $_POST['delete'];
            //   echo $id;
            //    $sql ="Delete FROM users where user_Id= '{$id}'" ;
            //    $result = mysqli_query($conn,$sql) or die("Query Failed");
            //    echo "<meta http-equiv='refresh' content='0'>";

            //}
      
            }
      ?>
    </tbody>
  </table>
</div>



<script> 

$('.delete').click(function(){
  var id=this.id;
            if(confirm("Are you sure?"))
            {
            
              $.ajax({
                          url: "./php/delete.php",
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

