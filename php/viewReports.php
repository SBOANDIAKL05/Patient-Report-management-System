<div class="input-group mt-5 mx-auto w-50 pb-3">
  <input type="text" class="form-control rounded" id="search" onkeyup="searchFunction()"  placeholder="Enter patient's name" />
  <br>
</div>




<div class="tableFixHead w-50 mx-auto  mt-4">
  
  <div class="dropdown pb-2 text-start float-end pt-2">
    <?php
    if($_SESSION["UserType"] == "Admin"){
      echo ' <button class="deleter btn btn-danger btn-md">Delete Unchecked</button>';
    }
    
    $url = basename($_SERVER['PHP_SELF']);
    ?>

    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="./Resources/Img/filter.png" alt="filter" height="20px">
      Filter
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <?php echo '
        <li><a name="all" class="dropdown-item" href="./'.$url.'?PageName=viewReports">Checked Only</a></li>
        <li><a name="each" class="dropdown-item"  href="./'.$url.'?PageName=viewReports&show=all">All</a></li>
        ';?>
      
    </ul>
</div>

  <table id="myTable" class="table mx-auto">
    
    <?php



        if(isset($_GET["show"]) == "All"){
              $sql0 ="SELECT patient.Id,patient.name, patient.age,patient.address, report.referedTo, report.date, report.reason, report.isFilled,report.Id as rid
                  FROM report
                  JOIN patient ON report.Patient_Id=patient.Id
                  JOIN users ON report.user_Id = users.Id"
                ;
                //}
                $result0 = mysqli_query($conn,$sql0) or die(mysqli_error($conn));
                
                
                echo '<thead class="table-light">
                <tr>
                <th scope="col">Report Id</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Adderss</th>
                <th scope="col">Date</th>
                <th scope="col">isChecked</th>
                <th scope="col"><th>
              </tr>
              </thead>
              <tbody>';
                while($row0=mysqli_fetch_assoc($result0))
                {
                  echo "<tr>";
                  echo '<td scope="col">' . $row0["rid"] . '</td>';
                  echo '<td scope="col">' . $row0["name"] . '</td>';
                  echo '<td scope="col">' . $row0["age"] . '</td>';
                  echo '<td scope="col">' . $row0["address"] . '</td>';
                  echo '<td scope="col">' . $row0["date"] . '</td>';
                  echo '<td scope="col">';
                  if($row0["isFilled"] == "0"){
                      echo 'no';
                  }
                  else
                  {
                      echo 'yes';
                  }
                  echo '</td>';
                  echo '<td scope="col">'; 
                  
                      
                      ?>
                      <?php
                      if($row0["isFilled"] == "0"){
                        echo '<a href="./'.$url.'?PageName=unfilledReport&id='.$row0["rid"] .'" class="btn btn-info btn-sm"';
                      }
                      else{
                        echo '<a href="./'.$url.'?PageName=userReport&id='.$row0["rid"] .'" class="btn btn-info btn-sm"';
                      }
                      echo '>View Report</a>';
                  
                  
                  if($_SESSION["UserType"] == "Admin")
                  {
                    echo '
                    <button id="'.$row0['rid'].'" class="delete btn btn-danger btn-sm">Delete</button>
                    ';
                  }
                  echo '</td></tr>
                  ';
                }
              }
            
        else{
              // if(isset($_POST["vreports"])){
              //   $vid= $_POST["vreports"];
              //   $sql ="SELECT patient.Id, patient.name, report.date, report.Disease, disease.name as dnam, report.Id as rid
              // FROM report
              // JOIN patient ON report.Patient_Id=patient.Id
              // JOIN users ON report.Doctor_Id = users.Id
              // JOIN disease ON report.Disease = disease.Id
              // where patient_Id = '$vid'";
              // }
              // else{
                $sql ="SELECT patient.Id, patient.name,patient.age,patient.address, report.date, disease.name as dnam, report.Id as rid
              FROM report
              JOIN patient ON report.Patient_Id=patient.Id
              JOIN users ON report.Doctor_Id = users.Id
              JOIN disease ON report.Disease = disease.Id"
              ;
              //}
              $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
              
              
              echo '<thead class="table-light">
              <tr>
              <th scope="col">Report Id</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Address</th>
                <th scope="col">Condition</th>
                <th scope="col">Date</th>
                <th scope="col"><th>
              </tr>
            </thead>
            <tbody>';
            $url = basename($_SERVER['PHP_SELF']);
              while($row=mysqli_fetch_assoc($result))
              {
                echo "<tr>";
                echo '<td scope="col">' . $row["rid"] . '</td>';
                echo '<td scope="col">' . $row["name"] . '</td>';
                echo '<td scope="col">' . $row["age"] . '</td>';
                echo '<td scope="col">' . $row["address"] . '</td>';
                echo '<td scope="col">' . $row["dnam"] . '</td>';
                echo '<td scope="col">' . $row["date"] . '</td>';
                echo '<td scope="col">'; 
                  echo '
                  <a href="./'.$url.'?PageName=userReport&id='.$row["rid"] .'" class="btn btn-info btn-sm">View Report</a>
                  
                  ';
                
                if($_SESSION["UserType"] == "Admin")
                {
                  echo '
                  <button id="'.$row['rid'].'" class="delete btn btn-danger btn-sm">Delete</button>
                  ';
                }
                echo '</td></tr>
                ';
              }
          
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

        $('.deleter').click(function(){
  
            if(confirm("Are you sure?"))
            {
            
              $.ajax({
                          url: "./php/deleteEmptyReports.php",
                          method:"POST",
                          data:{id:1},
                          success:function(data)
                          {   
                              location.reload(true);
                              
                          }
              });
            }
        });


        
  </script>

  

