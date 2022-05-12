<div class="input-group mt-5 mb-3 mx-auto w-50">

  <input type="text" class="form-control rounded pb-2" id="search" onkeyup="searchFunction()"  placeholder="Enter user's name" />

  <br>
</div>


<div class="tableFixHead w-75 mx-auto">
<div class="dropdown pb-2 w-25 pt-2 ms-auto">
<a class="btn btn-primary" href="./admin.php?PageName=createUser" role="button">Create New</a>
  <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    <img src="./Resources/Img/filter.png" alt="filter" height="20px">
    Filter
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" onclick="filtr('All')" href="#">All</a></li>
    <li><a class="dropdown-item" onclick="filtr('Doctor')" href="#">Doctor</a></li>
    <li><a class="dropdown-item" onclick="filtr('Staff')" href="#">Staff</a></li>
    <li><a class="dropdown-item"onclick="filtr('Admin')" href="#">Admin</a></li>
    
  </ul>
</div>
<table id="myTable" class="table mx-auto">
  <thead class="table-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Full Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Date of birth</th>
      <th scope="col">User Type</th>
      <th scope="col"><th>
    </tr>
  </thead>
  <tbody>
    <?php
       $sql ="SELECT * FROM users where ishidden = 0" ;
       $result = mysqli_query($conn,$sql) or die("Query Failed");


       //Edit garnu xa yaaaa tala////////////////////////////////////////////////////////////////
           while($row=mysqli_fetch_assoc($result))
           {
             echo "<tr>";
             echo '<td scope="col">' . $row["Id"] . '</td>';
            echo '<td scope="col">' . $row["name"] . '</td>';
            //echo '<th scope="col">' . $row["user_ID"] . '</th>';
            echo '<td scope="col">' . $row["email"] . '</td>';
            echo '<td scope="col">' . $row["phoneNumber"] . '</td>';
            echo '<td scope="col">' . $row["DOB"] . '</td>';
            echo '<td scope="col">';
            if($row["userType"] == "User") {
              echo 'Staff';
            }
            else{
              echo $row["userType"];
            }
            
            echo '</td>';
            echo '<td scope="col">
            <form method="POST" action="./admin.php?PageName=profile"> 
            <a href="./admin.php?PageName=profile&id='.$row["Id"] .'" class="btn btn-secondary btn-sm ">View</a>
            <a id='.$row['Id'].' class="delete btn btn-sm btn-danger"';
              if($row['Id'] == $_SESSION["User_ID"]){
                echo 'style="display:none;"';
              }
            echo '>Delete</a>
            </form>
            
            </button>
            </td>
          </tr>';

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


<script> 
$('.delete').click(function(){
            var id=this.id;
            if(confirm("Are you sure?"))
            {
            
              $.ajax({
                          url: "./php/userDelete.php",
                          method:"POST",
                          data:{id:id, tbl:'users'},
                          success:function(data)
                          {   
                              location.reload(true);
                              
                          }
              });
            }
        });

        const filtr = (asd) =>
    {
        let filter = asd;
        let myTable = document.getElementById("myTable");
        let tr = myTable.getElementsByTagName('tr');

        for(var i = 0; i < tr.length; i++){
          if(asd == "All"){
              tr[i].style.display = "table-row";

            }
            else
            {
              let td = tr[i].getElementsByTagName('td')[5];

              if(td){
                let textvalue = td.textContent || td.innerHTML;
            
              if(textvalue.indexOf(filter) > -1)
              {
                  tr[i].style.display = "";
              }
              else
              {
                  tr[i].style.display = "none";
              }
          }
          }
        }
    }
      
  </script>

</div>


<script>

</script>
