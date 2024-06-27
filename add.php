<?php

require('config.php');

$errors = array(); 
if (isset($_REQUEST['gym'])) {

  $price = mysqli_real_escape_string($conn, $_REQUEST['price']);
  $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
  $start = mysqli_real_escape_string($conn, $_REQUEST['start']);
  $end = mysqli_real_escape_string($conn, $_REQUEST['end']);
  
  $user_check_query = "SELECT * FROM gym WHERE package_name='$name' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['package_name'] === $name) {
      array_push($errors, "<div class='alert alert-warning'><b>Package already exists</b></div>");
    }
  }

  if (count($errors) == 0) {
    $query = "INSERT INTO gym (package_name,price,start_time,end_time) 
          VALUES('$name','$price','$start','$end')";
    $sql=mysqli_query($conn, $query);
    if ($sql) {
    $msg="<div class='alert alert-success'><b>Package added successfully</b></div>";
    }else{
      $msg="<div class='alert alert-warning'><b>Package not added</b></div>";
    }
  }
  
}

?>

<div class="w3-container">
 <form class="form-group mt-3" method="post" action="">
  <div><h3>ADD Package</h3></div>
   <?php include('errors.php'); 
    echo @$msg;

    ?>
  <label class="mt-3">Package name</label>
  <input type="text" name="name" class="form-control">
  <label class="mt-3">Package price</label>
  <input type="text" name="price" class="form-control">
  <label class="mt-3">Start Time</label>
  <input type="time" name="start" class="form-control"  min="09:00" max="22:00" required>
  <label class="mt-3">End Time</label>
  <input type="time" name="end" class="form-control"  min="09:00" max="22:00" required>
  
  <button class="btn btn-dark mt-3" type="submit" name="gym">Create</button>
 </form>
</div>
<div>
<?php
require('db.php');


$name="";



if (isset($_POST['name'])) {
 echo "<div class='container'>";
 echo "<table class='table table-bordered  table-hover mt-3'>";
 echo "<tr>";
 echo "<th>Package Name</th>";
 echo "<th>Price</th>";
 echo "<th>Operation</th>";
 echo "</tr>";
 echo "</div>";


 $name=$_POST['name'];


  $que=mysqli_query($conn,"SELECT * FROM 'gym' WHERE CONCAT('package_name','price','start_time','end_time') LIKE '"$name."%'");
  if(mysqli_num_rows($que) > 0){
 
 while($row=mysqli_fetch_array($que))
 {
  echo "<tr>";
  echo "<td>".$row['package_name']."</td>";
  echo "<td>".$row['price']."</td>";
  
  echo  "<td><a href='delete.php?name=$row[package_name]'><i class='fas fa-trash-alt'></i></a></td>";
  echo "</tr>";

 }
}else{
 echo "<div class='alert alert-warning'><b>0 result</b></div>";
}
 
}




 
?>
</div>