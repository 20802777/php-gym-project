<?php

require('config.php');

$errors = array(); 
if (isset($_REQUEST['member'])) {

  $mem_id = mysqli_real_escape_string($conn, $_REQUEST['username']);
  $pwd = mysqli_real_escape_string($conn, $_REQUEST['pwd']);
  $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
  $surname = mysqli_real_escape_string($conn, $_REQUEST['surname']);

  $dob = mysqli_real_escape_string($conn, $_REQUEST['dob']);
   
  
  
  $user_check_query = "SELECT * FROM login WHERE uname='$mem_id' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['mem_id'] === $mem_id) {
      array_push($errors, "<div class='alert alert-warning'><b>ID already exists</b></div>");
    }
  }


  if (count($errors) == 0) {
  

    $query = "INSERT INTO login (uname,pwd,name,surname,dob) 
          VALUES('$mem_id','$pwd','$name','$surname','$dob')";
    $sql=mysqli_query($conn, $query);
    if ($sql) {
    $msg="<div class='alert alert-success'><b>Member added successfully</b></div>";
    }else{
      $msg="<div class='alert alert-warning'><b>Member not added</b></div>";
    }
  }
}



?>






<div class="container">
 <form class="form-group mt-3" method="post" action="">
  <div><h3>ADD MEMBER</h3></div>
   <?php include('errors.php'); 
    echo @$msg;

    ?>
  <label class="mt-3">User Name</label>
  <input type="text" name="username" class="form-control">
  <label class="mt-3">Password</label>
  <input type="password" name="pwd" class="form-control">
  <label class="mt-3">Name</label>
  <input type="text" name="name" class="form-control">
  <label class="mt-3">Surname</label>
  <input type="text" name="surname" class="form-control">
  <label class="mt-3">Date of Birth</label>
  <input type="date" name="dob" class="form-control">
  <button class="btn btn-dark mt-3" type="submit" name="member">Register</button>
 </form>
</div>