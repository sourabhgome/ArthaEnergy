<?php
include 'SimpleXLSX.php';
$host='localhost';
$db_user='ArthaEnergyUser';
$db_password='ArthaEnergyPassword';
$db='ArthaEnergy';
$conn = new mysqli($host, $db_user, $db_password,$db);
if ($conn->connect_error) 
{
 die("Connection failed: " . $conn->connect_error);
}
if($xlsx=SimpleXLSX::parse($_FILES["fileInputTag"]["tmp_name"]))
{
 $sheet=$xlsx->rows();
 $n=count($sheet);
 for($i=1;$i<$n;$i++)
 {
  $sql="INSERT into sheet(station,energy) values(\"".$sheet[$i][0]."\",".$sheet[$i][1].")";
  if ($conn->query($sql) === TRUE) 
  {
  }
  else 
  {
   echo "Error creating table: " . $conn->error;
  }
 }
 $conn->close();
}
else
{
 echo SimpleXLSX::parseError();
}
header("Location: table.php");
exit;
?>