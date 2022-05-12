<?php
   session_start();
  if(empty($_SESSION) || !isset($_SESSION["UserType"]) || !isset($_SESSION["User_ID"])){
    header('Location: index.php');
  }
  if($_SESSION["UserType"] == "Admin"){
    header('Location: admin.php');
  }
  include("./php/conn.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./Css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body>
    <script type="text/javascript" src="./JS/main.js"></script>
    <script type="text/javascript" src="./bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./JS/jquery-3.6.0.min.js" ></script>
    
 

<!-- Nav-Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Patient Report Management System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="main.php?PageName=profile&id=<?php echo $_SESSION["User_ID"];?>">
          <img src="./Resources/Img/profile.png" alt="as" width="25px"/>
          <?php echo $_SESSION["name"] ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./php/logout.php">Log-Out</a>
        </li>
      </ul>
    </div>
  </div>

</nav>


<!-- Body -->


<!-- Side Navigation -->




<section id="sidebar"> 
        <div class="white-label">
        </div> 
        <div id="sidebar-nav">   
        <ul class="nav flex-column text-light">

  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="main.php?PageName=patient">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="main.php?PageName=createNew">Create New</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="main.php?PageName=viewPatient">Patients</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="main.php?PageName=viewReports">Reports</a>
  </li>
  <!-- <li class="nav-item">
    <a class="nav-link " href="main.php?PageName=myBlog">My Blog</a>
  </li> -->
</ul>
        </div>
      </section> 
        
</div>


    <div class="mainn">
        <?php
        
        
          if(!empty($_GET['PageName']))
          {
            $pagesDirectory = "php";
            $pagesFolder = scandir($pagesDirectory,0);
            unset($pagesFolder[0],$pagesFolder[1]);
            // print_r($pagesFolder); 
            $pageName=$_GET['PageName'];

            if(in_array($pageName.'.php',$pagesFolder)){
              include($pagesDirectory.'/'.$pageName.'.php');
            }
            
          }
           else{

            include('./php/patient.php');
           }
          
        ?>
      </div>

</div>


</div>
</div>
    
</body>
</html>