<!doctype html>
<html>
 <head>
  <script>
   prev=0;
   function editListener(n)
   {
    var energyInput,energyLabel,editButton,doneButton;
    if(prev==0)
    {
     energyInput=document.getElementById("energyInput"+n);
     energyLabel=document.getElementById("energyLabel"+n);
     energyInput.style.display='block';
     energyLabel.style.display='none';
     editButton=document.getElementById("edit"+n);
     doneButton=document.getElementById("done"+n);
     doneButton.style.display='block';
     editButton.style.display='none';
     prev=n;
    }
    else
    {
     energyInput=document.getElementById("energyInput"+prev);
     energyLabel=document.getElementById("energyLabel"+prev);
     energyInput.style.display='none';
     energyLabel.style.display='block';
     editButton=document.getElementById("edit"+prev);
     doneButton=document.getElementById("done"+prev);
     doneButton.style.display='none';
     editButton.style.display='block';
     energyInput=document.getElementById("energyInput"+n);
     energyLabel=document.getElementById("energyLabel"+n);
     energyInput.style.display='block';
     energyLabel.style.display='none';
     editButton=document.getElementById("edit"+n);
     doneButton=document.getElementById("done"+n);
     doneButton.style.display='block';
     editButton.style.display='none';
     prev=n;
    }
   }   
   function updateRow(n)
   {
    var energyInput,energyLabel,editButton,doneButton,totalEnergyLabel;
    energyInput=document.getElementById("energyInput"+n);
    energyLabel=document.getElementById("energyLabel"+n);
    energyInput.style.display='none';
    energyLabel.style.display='block';
    editButton=document.getElementById("edit"+n);
    doneButton=document.getElementById("done"+n);
    doneButton.style.display='none';
    editButton.style.display='block';
    if(energyLabel.innerHTML!=energyInput.value)
    {
     prevEnergy=parseFloat(energyLabel.innerHTML);
     totalEnergyLabel=document.getElementById("totalEnergy");
     totalEnergy=parseFloat(totalEnergyLabel.innerHTML);
     currentEnergy=parseFloat(energyInput.value);
     totalEnergyLabel.innerHTML=(totalEnergy-prevEnergy+currentEnergy);
     energyLabel.innerHTML=currentEnergy;
     var xhttp = new XMLHttpRequest();
     xhttp.open("POST", "updateEnergy.php", true); 
     xhttp.setRequestHeader("Content-Type", "application/json");
     xhttp.onreadystatechange = function() 
     {
      if (this.readyState == 4 && this.status == 200) 
      {
       var response = this.responseText;
      }
     };
     var data = {code:n, energy: currentEnergy};
     xhttp.send(JSON.stringify(data));
    }
    prev=0;
   }
  </script>
 </head>
 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
 <body>
  <div class="container-fluid">
   <div class="row align-middle">
    <p class='display-2 text-center'>Artha Energy</p>
   </div>
   <div class="row">
    <?php
    $host='localhost';
    $db_user='ArthaEnergyUser';
    $db_password='ArthaEnergyPassword';
    $db='ArthaEnergy';
    $conn = new mysqli($host, $db_user, $db_password, $db);
    if ($conn->connect_error) 
    {
     die("Connection failed: " . $conn->connect_error);
    }
    $sql="Select code, station, energy from sheet";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
     echo "<table id='table' class='table table-bordered'>";
     echo "<thead class='thead-dark'>";
     echo "<th>S No.</th>";
     echo "<th>Station</th>";
     echo "<th>Energy</th>";
     echo "<th>Edit</th>";
     echo "</thead>";
     echo "<tbody>";
     $i=1;
     while($row = $result->fetch_assoc())
     {
      echo "<tr id='row".$i."'>";
      echo "<td id='code".$i."'>".$row["code"]."</td>";
      echo "<td id='station".$i."'><label id='stationLabel".$i."'>".$row["station"]."</label><input id='stationInput".$i."' class='input-group-text' style='display:none' value=".$row["station"]."/></td>";
      echo "<td id='energy".$i."'><label id='energyLabel".$i."'>".$row["energy"]."</label><input id='energyInput".$i."' class='input-group-text' style='display:none' value=".$row["energy"]."></button></td>";
      echo "<td><button class='btn btn-dark' id='edit".$i."' onclick=editListener(".$i.")>Edit</button>";
      echo "<button class='btn btn-primary' style='display:none;' id='done".$i."' onclick=updateRow(".$i.")>Done</button>";
      echo "</td>";
      echo "</tr>";
      $i++;
      #echo "code: " . $row["code"]. " - Station: " . $row["station"]. " " . $row["energy"]. "<br>";
      }
      echo "</tbody>";
      echo "</table>";
      $sql="Select SUM(energy) as total from sheet";
      $result=$conn->query($sql);
      if($result->num_rows>0)
      {
       echo "<label id='totalEnergyLabel' class='display-4'>Total Energy : </label><label id='totalEnergy' class='display-4'>".$result->fetch_assoc()['total']."</label>";
      }
     }
     else
     {
      echo "0 results";
     }
     $conn->close();
     exit;
    ?>
   </div>
  </div>
 </body>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 <script src="js/bootstrap.min.js"></script>
</html>