<div class="container-fluid mt-5 w-50 pt-5"> 

  <div class="card w-100 mb-5" style="width: 18rem;">
    <h5 class="card-header">Dashboard</h5>
      <div class="card-body p-4">
      <div class="row">
        <div class="col-3">
        <div class="card" >
      <div class="card-header py-4 ">
        <h3 class="card-title">
        <img src="./Resources/Img/social-group.png" alt="as" width="30px"/>
        <?php
          $result = mysqli_query($conn, 'SELECT COUNT(id) AS value_sum FROM users where ishidden=0 and userType="user"'); 
          $row = mysqli_fetch_assoc($result); 
          $sum = $row['value_sum'];
          echo " $sum";
        ?>
        </h3>
        <h5 class="card-text">Staffs</h5>
      </div>
    </div>
      </div>

      <div class="col-3">
          <div class="card" >
                  <div class="card-header py-4 ">
                  <h3 class="card-title">
                  <img src="./Resources/Img/doctor.png" alt="as" width="30px"/>
                  <?php
                    $result = mysqli_query($conn, 'SELECT COUNT(id) AS value_sum FROM users where userType="Doctor" and ishidden=0'); 
                    $row = mysqli_fetch_assoc($result); 
                    $sum = $row['value_sum'];
                    echo " $sum";
                  ?>
                  </h3>
                  <h5 class="card-text">Doctors</h5>
              </div>
          </div>
      </div>

      <div class="col-3">
      <div class="card">
    <div class="card-header py-4 ">
      <h3 class="card-title">
      <img src="./Resources/Img/patient.png" alt="as" width="30px"/> 
      <?php
          $result = mysqli_query($conn, 'SELECT COUNT(id) AS value_sum FROM patient'); 
          $row = mysqli_fetch_assoc($result); 
          $sum = $row['value_sum'];
          echo " $sum";
        ?>
      </h3>
      <h5 class="card-text">Patients</h5>
    </div>
  </div>
      </div>
      <div class="col-3">
          <div class="card" >
                  <div class="card-header py-4">
                    <h3 class="card-title">
                    <img src="./Resources/Img/notepad.png" alt="as" width="30px"/>
                    <?php
                      $result = mysqli_query($conn, 'SELECT COUNT(Id) AS value_sum FROM report where isFilled=1'); 
                      $row = mysqli_fetch_assoc($result); 
                      $sum = $row['value_sum'];
                      echo " $sum";
                    ?>
                    </h3>
                    <h5 class="card-text"> Reports</h5>
                  </div>
           </div>
      </div>
    </div>
  </div>

  </div>

  <!-- Table----------------------------------------------------------------------------- -->
  <div class="card w-100" style="width: 18rem;">
    <h5 class="card-header">Pending List</h5>
    <div class="card-body p-4">

      <!-- Table -->
      <table class="table align-middle">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Password</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql = "SELECT * from pending";
            $result = mysqli_query($conn,$sql) or die("Query Failed");

            while($row=mysqli_fetch_assoc($result))
            {
              $id = $row["Id"];
              $sql = "SELECT name, email, phoneNumber, password from users where Id=$id";
              $result2 = mysqli_query($conn,$sql) or die("Query Failed");
              while($asd=mysqli_fetch_assoc($result2))
              {
                echo '
                <tr>
                  <th scope="row">Current: <br> To:</th>
                  <td>'.$asd["name"].' <br> '.$row["name"].' </td>
                  <td>'.$asd["email"].' <br> '.$row["email"].'</td>
                  <td>'.$asd["phoneNumber"].' <br> '.$row["phoneNumber"].'</td>
                  <td>******** <br> ********</td>
                  <td>  <form method="POST" action="">
                  <button type="submit" name="submit" value="'.$row["Id"] .'" class="btn btn-success btn-sm">Approve</button>
                  <a id='.$row['Id'].' class="delete btn btn-sm btn-danger">Delete</a>
                  </form>
                </tr>
                ';
              }
            }
            

            if (isset($_POST['submit'])) 
            {
              $categoty;
              $id=$_POST["submit"];
              $sql = "SELECT * from pending where Id= '$id'";
              $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
              while($row=mysqli_fetch_assoc($result))
              {
                $sql ="UPDATE users SET name = '{$row["name"]}', email ='{$row["email"]}', PhoneNumber= '{$row["phoneNumber"]}', password='{$row["password"]}' WHERE Id='$id'" ;
                $categoty= $row["category"];
              }

              $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    
              if($result)
              {
                $sql = "Delete FROM pending where Id= $id";
                $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                if($result)
                {
                  echo ' <Script>
                  document.getElementById("'.$id.'").click();
                  alert("Edit Approved!");
                  </script>';
                  echo "<meta http-equiv='refresh' content='0'>";
                }
              }

            }

          ?>
        </tbody>
      </table>
      
    </div>
  </div>
</div>

<script> 
$('.delete').click(function(){
            var id=this.id;
            if(confirm("Are you sure?"))
            {
            
              $.ajax({
                          url: "./php/delete.php",
                          method:"POST",
                          data:{id:id, tbl:'pending'},
                          success:function(data)
                          {   
                              location.reload(true);
                              
                          }
              });
            }
        });
      
  </script>
