<?php $link = connect(); ?>

<h2 class='py-3'>Оставить комментарии</h2>

<form action = 'index.php?page=2' method = 'POST'>
    <div class="row">
        <div class="col-md-6 col-12">
            
                <select name='hotel_id' class = 'form-control'>
                    <?php
                    $sel = 'SELECT* FROM hotels';
                    $res = mysqli_query($link, $sel);                    
                    ?>
                    <?php while($row = mysqli_fetch_array($res)): ?>
                        
                    <option value = "<?php echo $row['id']?>"><?php echo $row['hotel']?></option>
                    <?php endwhile; mysqli_free_result($res);?>

                </select>
                <h6 class='py-3'>Оставьте комментарий:</h6>
                <textarea name="info_hotel" placeholder = 'Комментарий'></textarea>
                <button type = 'submit' name = 'set_info' class = 'btn btn-info'>OK</button>           

        </div>
        
    </div>
     
</form>
<?php
    if(isset($_POST['set_info'])) {
        $infoHotel = $_POST['info_hotel'];
        $users_id = $_SESSION['users_id'];
        $hotel_id = $_POST['hotel_id']; 
        if($infoHotel == '') exit();
        $int = 'INSERT INTO comments(comment, users_id, hotel_id)
        VALUES("'.$infoHotel.'", "'.$users_id.'", "'.$hotel_id.'")';        
        mysqli_query($link, $int);       
    }    
?>
     
     <?php
    $insertInfo = 'SELECT comments.comment, users.login, hotels.hotel FROM comments, users, hotels
    WHERE comments.users_id = users.id AND comments.hotel_id = hotels.id';
    $res = mysqli_query($link, $insertInfo);    
    ?>

<table class = 'table table-striped my-5'>
    <thead>
        <tr>
            <td>Отель</td>
            <td>Комментарий</td>
            <td>Пользователь</td>            
        </tr>
    </thead>
    <thbody>
        <?php while($row = mysqli_fetch_array($res)):?>
            
            <tr>
                <td><?php echo $row[2]?></td>
                <td><?php echo $row[0]?></td>
                <td><?php echo $row[1]?></td>
                
            </tr>
        <?php endwhile; mysqli_free_result($res);?>

    </thbody>
</table>