<?php include_once('functions.php')?>


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
  <?php include_once('menu.php');?>       
  
  <?php
  if(isset($_POST['out_btn'])) {
    logout();
  }
  ?>
</nav>


<div class="container py-5">
    <?php
    if(isset($_GET['hotel'])):
        $link = connect();
        $hotel_id = $_GET['hotel'];
        $sel = 'SELECT * FROM hotels WHERE id ='.$hotel_id;
        $res = mysqli_query($link, $sel);
        $row = mysqli_fetch_array($res);

        $hotel = $row['hotel'];
        $stars = $row['stars'];
        $cost =$row['cost'];
        $infoHotel = $row['info'];
        mysqli_free_result($res);

    endif ?>

    <h2 class='my-3'><?php echo $hotel?></h2>
    <div class="my-3">
        <div class="d-flex">

        <?php
        $sel = 'SELECT * FROM images WHERE hotel_id='.$hotel_id;
        $res = mysqli_query($link, $sel);
        while($row= mysqli_fetch_array($res)):
        ?>
        <img style = 'width:150px' src= '<?php echo "../".$row['image_path']?>' alt='foto' >

        <?php endwhile; mysqli_free_result($res)?>
        

        </div>
    </div>
    <div class="my-3">
        <ul class = 'd-flex justify-content-start' style='list-style-type: none;'>
            <?php for($i=0; $i<$stars; $i++): ?>
            <li><img src="../images/star.png" alt="star_foto" style ='height: 30px; widht:30px'></li>
            <?php endfor;?>
        </ul>
    </div>
    <div class="my-3">
        <p>Цена: <?php echo $cost ?> руб</p>
    </div>
    <div class="my-3">
        <p><?php echo $infoHotel ?></p>
    </div>
    <h6>Комментарии</h6>
    <?php
    $insertInfo = 'SELECT comments.comment, users.login FROM comments, users WHERE comments.users_id = users.id AND hotel_id ='.$hotel_id;
    $res = mysqli_query($link, $insertInfo);
    while($row = mysqli_fetch_array($res)):    
    ?>
    <div class="my-3">
      <p>Пользователь: <?php echo $row[1] ?></p>
        <p>Отзыв: <?php echo $row[0] ?></p>
    </div>
    <?php endwhile; mysqli_free_result($res)?>  
   
</div>
    
</body>
</html>