<?php
require('config.php');


$inf=$_GET['name'];


$sql_member="DELETE FROM gym WHERE package_name='$inf'";
$sql_query_mem=mysqli_query($conn,$sql_member);

if ($sql_query_mem) {
 echo "package deleted";
}else{
 echo "not delted";
}







 
 
 
?>