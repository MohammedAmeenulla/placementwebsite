<?php
session_start();
$errors=array();
$db=mysqli_connect('localhost','root','','placementdrive') or die("could not connect to database");

$usn="";
if(isset($_POST['login'])){

          $usn=mysqli_real_escape_string($db, $_POST['usn']);
          $password=mysqli_real_escape_string($db, $_POST['password']);
    
    if(empty($usn))
    {    array_push($errors,"Usn is required");}
      if(empty($password))
    {    array_push($errors,"password is required");}
   
    
    if(count($errors)==0){
       
        
        $query="select * from registration where usn='$usn' and password='$password' ";
          
          $results=mysqli_query($db,$query);
              
          if(mysqli_num_rows($results)) {
              $_SESSION['usn']=$usn;
             echo '<script type="text/JavaScript">
      alert("Successfully Logged In");
      window.location= "shome.html"
     </script>' ;
              
          } 
        else{
               echo '<script type="text/JavaScript">  
      alert("Incorrect usn or Password"); 
            window.location= "login.html"

     </script>' ;
        }      
              
          }
        
        
        
    }
?>