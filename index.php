<?php
    session_start();
    if(isset(($_SESSION["UserType"])))
    {
        if($_SESSION["UserType"] == "Admin"){
            header('Location: admin.php');
        }
        if($_SESSION["UserType"] == "User" || $_SESSION["UserType"] == "Doctor"){
            header('Location: main.php');
        }
}
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Css/index.css">
</head>
<body>
    <body>
        <div class="form-wrapper" id="wrapper-login">
            <!-- <img src="./Resources/Img/OQ6UTW0.jpg" alt=""> -->
            
            <div class="content-wrapper" id="content-signin">
        
                    <h1 class="title">Patient Report Management System</h1>
                
                <form class="form-login" method="POST" action="index.php">
                    <input type="email" name="email" placeholder="Email" class="input-username" required/>
                    <input type="password" name="password" placeholder="Password" class="input-password" required/>
                    <div class="wrong"></div>
                    <button type="submit" class="btn-login" name="submit">LOGIN</button>
                </form>
            
        

        <?php
if(isset($_POST['submit']))
{

include("./php/conn.php");
function check_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$usr=$psw="";
$usr=check_input($_POST['email']);
$psw=check_input($_POST['password']);
$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";


if ( !preg_match($pattern, $usr) || !preg_match('/[A-Za-z0-9A-Za-z!@#$%]+$/', $psw)) {
    echo '<span style="color:red;">Enter Valid Details</span>';
    
}
else{
    setcookie("id",$usr,time()+(24*24*60*60*60));
setcookie("pass",$psw,time()+(24*24*60*60*60));

  $sql ="SELECT * FROM users WHERE email='{$usr}' AND password= '{$psw}' AND ishidden = 0" ;
$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

if(mysqli_num_rows($result)>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
        session_start();
        $_SESSION["name"] = $row['name'];
        $_SESSION["User_ID"] = $row['Id'];
        $_SESSION["User_Password"] = $row['password'];
        $_SESSION["UserType"] = $row['userType'];

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
        if($row['userType']=="Admin")
        {
            header("Location: admin.php");
        }
            
        else 
        {
            header("Location: main.php");
        }
            
        
    }
}
else{
    echo "Enter Valid Details";
}
}





}
?>
</div>
</div>
        
    </body>
</body>
</html>