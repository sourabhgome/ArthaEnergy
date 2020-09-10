<!doctype html>
<html>
<head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
 <div class="container-fluid">
  <div class="row align-middle">
   <p class='display-2 text-center'>Artha Energy</p>
  </div>
  <div class="row">
   <form action="upload.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
     <p class='display-4'>Select file to upload:</p>
     <input accept='.xlsx' type="file" class="form-control-file" name="fileInputTag" id="fileInputTag"/>
     <br/>
     <input type="submit" class="btn btn-lg btn-dark" value="Upload" name="submit"/>
    </div>
   </form>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
</html>