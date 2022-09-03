<?php
session_start();
$usn="";
$name = "";
$email_id = "";
$phno= "";
$branch="";
$password_1 = "";
$password_2 ="";

$errors=array();

//REGISTRATION FORM FIELDS
$db=mysqli_connect('localhost','root','','placementdrive') or die("could not connect to database");


if(isset($_POST['register'])){

$usn = mysqli_real_escape_string($db,$_POST['usn']);
$name = mysqli_real_escape_string($db,$_POST['name']);
$email_id = mysqli_real_escape_string($db,$_POST['email']);
$phno = mysqli_real_escape_string($db,$_POST['phone']);
$branch = mysqli_real_escape_string($db,$_POST['branch']);
$password_1 = mysqli_real_escape_string($db,$_POST['password']);
$password_2 = mysqli_real_escape_string($db,$_POST['confirmPassword']);

//ERRORS
if(empty($usn))array_push($errors,"usn is required");
if(empty($name))array_push($errors,"name is required");
if(empty($email_id))array_push($errors,"email_id is required");
if(empty($branch))array_push($errors,"branch is required"); 
if(empty($password_1))array_push($errors,"password is required");              
if($password_1!=$password_2){array_push($errors,"passwords should match");
                       echo '<script type="text/JavaScript">  
      alert("Passwords do not match");  
     </script>' ; 
        ;}
if($phno == ""){array_push($errors,"phone_no required");
                       echo '<script type="text/JavaScript">  
      alert("Please enter your phone number");  
     </script>' ; 
        ;}
//QUEIRES    
$login_check_query="select * from registration where usn='$usn' LIMIT 1";
$results=mysqli_query($db,$login_check_query);
$login=mysqli_fetch_assoc($results);

    
if($login){
    if($login['usn']==$usn){array_push($errors,"usn already exists");
                               echo '<script type="text/JavaScript">  
      alert("Usn already registered");  
     </script>' ;}
}

if(count($errors)==0)
{
    $query="insert into registration (usn,email_id,name,phno,branch,password) values ('$usn','$email_id','$name','$phno','$branch','$password_1')";
    $result11 = mysqli_query($db,$query);
    
    if($result11){
    $_SESSION['usn']=$usn;

   echo '<script type="text/JavaScript">  
      alert("Successfully Registered");
     window.location= "shome.html"
     </script>';}
    else{
        echo '<script type="text/JavaScript">  
      alert("Some error occured");

     </script>';
    }
    }
    else{
        echo '<script type="text/JavaScript">  
      alert("Failed. Try again");
     window.location= "registration.html"
     </script>';
        
        
        
    }
}

?>
