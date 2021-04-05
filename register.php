<?php

 try{

if(isset($_POST['submit']) && !empty($_POST['submit']) || isset($_POST['id'])){
    
   
    $host = "localhost";
    $port = "5432";
    $dbname = "creativez_register";
    $user = "creativez_mona";
    $password = "Testing@345"; 
    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    
    $dbconn = pg_connect($connection_string);
 
    
     
    
    if(isset($_GET['mode'])){
    
    $sql ="select *from users.fb_login where email = '".pg_escape_string($_POST['email'])."'";
    $data = pg_query($dbconn,$sql); 
    $login_check = pg_num_rows($data);
    echo "hello";
    if($login_check > 0)
    {
        echo "<script>window.location.href='Home.php';</script>";
    }
    else
    {
        $name=$_POST['first_name'].' '.$_POST['last_name'];
    $sql = "INSERT INTO fb_login (name, email, password, mobile) VALUES ('".$name['name']."','".$_POST['email']."','pass','');";
    }
    }
    else
    {
        $sql_register_email ="select *from public.users where email = '".pg_escape_string($_POST['email'])."'";
        $sql_register_number ="select *from public.users where mobile = '".pg_escape_string($_POST['mobile'])."'";
    $dataEmail = pg_query($dbconn,$sql_register_email); 
        $dataMobile = pg_query($dbconn,$sql_register_mobile); 

    $register_check_email = pg_num_rows($dataEmail);
     $register_check_Mobile = pg_num_rows($dataMobile);
         if($register_check_email > 0 || $register_check_Mobile>0)
    {
        echo "User already registered";
    }
    else
    {
    
    $sql = "INSERT INTO users (name, email, password, mobile) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['pwd']."','".$_POST['mobno']."');";
     $ret = pg_query($sql);

    if($ret){
         echo "Data saved successfully";
         echo "<script>window.location.href='login.php';</script>";
         
    }else{
         echo "Something went wrong";
    }
    pg_close($dbconn);
    }
    }
   
    
}

}catch(Exception $ex)
    {
        echo $ex;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CreativeZCreationZ Register</title>
  <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}

.icon {
  padding: 10px;
  background: dodgerblue;
  color: white;
  min-width: 50px;
  text-align: center;
}

.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid dodgerblue;
}

/* Set a style for the submit button */
.btn {
  background-color: dodgerblue;
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}
</style>
<body>
<div class="container">
  <h2>Register Here </h2>
  <form method="post">
  
    <div class="form-group">
      
      <i class="fa fa-user icon"></i>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" requuired>
    </div>
    
    <div class="form-group">
      
      <i class="fa fa-envelope icon"></i>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    
    <div class="form-group">
      
      <i class="fa fa-phone icon"></i>
      <input type="number" class="form-control" maxlength="10" id="mobileno" placeholder="Enter Mobile Number" name="mobno">
    </div>
    
    <div class="form-group">
      
      <i class="fa fa-key icon"></i>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
     
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
  </form>
</div>
</body>
</html>