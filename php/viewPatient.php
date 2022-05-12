<div class="input-group mt-5 mx-auto w-50 pb-3">
  <input type="text" class="form-control rounded" id="search" onkeyup="searchFunction()"  placeholder="Enter patient's name" />
  <br>
</div>




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
        <th scope="col">Address</th>
        <th scope="col">Regestered By</th>
        <th scope="col"><th>
      </tr>
    </thead>
    <tbody>
    <?php
    $date = date('Y-m-d');
    
        $sql ="SELECT patient.Id, patient.name, patient.age, patient.gender,patient.address, users.name as uname from patient
        join users on users.id = patient.registeredBy";
        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        $url = basename($_SERVER['PHP_SELF']);


        //Edit garnu xa yaaaa tala////////////////////////////////////////////////////////////////
            while($row=mysqli_fetch_assoc($result))
            {
              echo "<tr>";
              echo '<td scope="col">' . $row["Id"] . '</td>';
               echo '<td scope="col">' . $row["name"] . '</td>';
               echo '<td scope="col">' . $row["age"] . '</td>';
               echo '<td scope="col">' . $row["gender"] . '</td>';
               echo '<td scope="col">' . $row["address"] . '</td>';
               echo '<td scope="col">' . $row["uname"] . '</td>';
               echo '<td scope="col">'; 
                 echo '
                 <form method="POST" action="./'.$url.'?PageName=';
                 if($_SESSION["UserType"] == "Doctor"){
                   echo 'createReport"> ';
                 }
                 else{
                  echo 'report"> ';
                 }
                 echo '
                 
                 <button type="submit" name="id" value="'.$row["Id"] .'" class="btn btn-danger btn-sm">New Report</button>
                 
                 ';
                 $url = basename($_SERVER['PHP_SELF']);
               
               if($_SESSION["UserType"] == "Admin")
               {
                 echo '<a id='.$row['Id'].' class="delete btn btn-danger btn-sm">Delete</a>
                    
                 ';
               }
               echo '
               <a href="./'.$url.'?PageName=patientDetails&id='.$row["Id"] .'" class="btn btn-info btn-sm">Details</a>
               </td></tr>
               </form>';
      
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
                          url: "./php/deletePatient.php",
                          method:"POST",
                          data:{id:id},
                          success:function(data)
                          {   
                              location.reload(true);
                              
                          }
              });
            }
        });
  </script>

