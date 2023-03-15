<?php include_once('pages/functions.php')?>
<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Tours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <?php include_once('pages/menu.php');?>
  <div class="col-md-6 text-end">
    <a href="index.php?page=5">
    <button type="button" class="btn btn-outline-primary me-2">Login</button>    
    </a>
        
  </div>
  <?php if(isset($_SESSION['registered_user'])):?>
    <div class="col text-end">
    <form action = "index.php" method = 'POST'>
    <button type="submit" class="btn btn-outline-primary me-2" name = 'out_btn'>Logout</button>
    </form>
  <?php else:?>    
  <?php endif?>       
  </div>
  <?php
  if(isset($_POST['out_btn'])) {
    Logout();
  }
  ?>
</nav>


<div class="container py-5">
    <?php
    if(isset($_GET['page'])) {
        $page = $_GET['page'];

        if ($page == 1) include_once('pages/tours.php');
        if ($page == 2) include_once('pages/comments.php');
        if ($page == 3) include_once('pages/registration.php');
        if ($page == 4) include_once('pages/admin.php');
        

    }
     
    ?>
</div>
    
</body>
</html>