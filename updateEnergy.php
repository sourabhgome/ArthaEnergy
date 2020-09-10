<?php
 $data = json_decode(file_get_contents("php://input"));
 $code = $data->code;
 $energy = $data->energy;
 $host='localhost';
 $db_user='ArthaEnergyUser';
 $db_password='ArthaEnergyPassword';
 $db='ArthaEnergy';
 $conn = new mysqli($host, $db_user, $db_password,$db);
 if ($conn->connect_error) 
 {
  die("Connection failed: " . $conn->connect_error);
 }
 $sql = "update sheet set energy=".$energy." where code=".$code;
 if(mysqli_query($conn,$sql))
 {
  echo 1; 
 }
 else
 {
  echo 0;
 }
 exit;
?>