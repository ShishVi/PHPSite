<h2 class='py-3'>Консоль администратора</h2>

<div class="row">
    <div class="col-md-6 col-12">
        <?php
        $link = connect();
        $sel = 'SELECT * FROM countries ORDER BY id';
        $res = mysqli_query($link, $sel);        
        ?>
        <form action ='index.php?page=4' method = 'POST'>
            <table class= 'table table-striped'>
                <?php while($row_country = mysqli_fetch_array($res)):?>
                    <tr>
                        <td><?php echo $row_country['id']?></td>
                        <td><?php echo $row_country['country']?></td>
                        <td>
                            <input type = 'checkbox' name = "<?php echo "cb". $row_country['id']?>">
                        </td>
                    </tr>
                <?php endwhile; mysqli_free_result($res);?>

            </table>

            <div class="form-group">
                <input type= 'text' name = 'country' class = 'form-control' placeholder = 'Страна'>
                <button type="submit" name='add_country' class='btn btn-info'>Добавить</button>
                <button type="submit" name='del_country' class='btn btn-danger'>Удалить</button>
            </div>        

        </form>
        <?php
        if(isset($_POST['add_country']))
        {
            
            $country = trim(htmlspecialchars($_POST['country']));

            if($country == "") exit();
            $ins = 'INSERT INTO countries(country) VALUES ("'.$country.'")';
            mysqli_query($link , $ins);
            echo'<script>window.location=document.URL</script>';

        }
        
        
        if(isset($_POST['del_country']))
        {
            foreach($_POST as $key=>$value)
            {
                if(substr($key,0,2) == "cb") {
                    $countryId = substr($key,2);                    
                    $del = 'DELETE FROM countries WHERE id='.$countryId;
                    mysqli_query($link, $del);

                }
            }

            echo'<script>window.location=document.URL</script>';
        }
        
        ?>

    </div>
    <div class="col-md-6 col-12">
    <form action ='index.php?page=4' method = 'POST' id = 'formCity'>
        <?php
        $sel = 'SELECT cities.id, cities.city, countries.country FROM cities, countries WHERE cities.country_id = countries.id ORDER BY id';
        $res = mysqli_query($link, $sel);
        ?>
        <table class= 'table table-striped'>      

        <?php while($row = mysqli_fetch_array($res)):?>
        <tr>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['city']?></td>
            <td><?php echo $row['country']?></td>
            <td><input type = 'checkbox' name = "<?php echo "cx". $row['id']?>"></td>        
        </tr>
        <?php endwhile; mysqli_free_result($res)?>
        
        </table>  
        
        <?php
        $sel = 'SELECT * FROM countries';
        $res = mysqli_query($link, $sel);
        ?>
        <select name ='country_name' class = 'form-control'>
            <?php while($row= mysqli_fetch_array($res)):?>
            <option value ="<?php echo $row['id']?>"><?php echo $row['country']?></option>
            <?php endwhile; mysqli_free_result($res)?>

        </select>

        <div class="form-group">
                <input type= 'text' name = 'city' class = 'form-control' placeholder = 'Город'>
                <button type="submit" name='add_city' class='btn btn-info'>Добавить</button>
                <button type="submit" name='del_city' class='btn btn-danger'>Удалить</button>
        </div>
    </form>
    <?php
    if(isset($_POST['add_city'])) {
        
        $city = trim(htmlspecialchars($_POST['city']));
        if($city == '') exit();
        
        $countryId = $_POST['country_name'];
        $ins = 'INSERT INTO cities(city, country_id) VALUES ("'.$city.'", "'.$countryId.'")';
        mysqli_query($link, $ins);
        echo'<script>window.location=document.URL</script>';

    }

    if(isset($_POST['del_city']))
        {
            foreach($_POST as $key=>$value)
            {
                if(substr($key,0,2) == "cx") {
                    $cityId = substr($key,2);                    
                    $del = 'DELETE FROM cities WHERE id='.$cityId;
                    mysqli_query($link, $del);

                }
            }

            echo'<script>window.location=document.URL</script>';
        }
    
    ?>
    </div>
    <div class="col-md-6 col-12">
    <form action ='index.php?page=4' method = 'POST'>
        <?php
        $sel = 'SELECT cities.id, cities.city, hotels.id, hotels.hotel, hotels.city_id, hotels.country_id,
        hotels.stars, hotels.info, countries.id, countries.country FROM cities, hotels, countries
        WHERE hotels.city_id = cities.id AND hotels.country_id = countries.id';

        $res = mysqli_query($link, $sel);
       
        ?>
        <table class= 'table table-striped'>
            <?php while($row = mysqli_fetch_array($res)):?>
                <tr>
                    <td><?php echo $row[2]?></td>
                    <td><?php echo $row[1]. "-" . $row[9]?></td>
                    <td><?php echo $row[3]?></td>
                    <td><?php echo $row[6]?></td>
                    <td>
                        <input type="checkbox" name = '<?php echo "ch". $row[2]?>'>
                    </td>
                </tr>
            <?php endwhile; mysqli_free_result($res)?>
        </table>
        <?php
        $sel = 'SELECT cities.id, cities.city, countries.id, countries.country FROM cities, countries WHERE countries.id = cities.country_id';
        $res = mysqli_query($link, $sel);
        $city_sel =[];
        ?>
        <select name ='h_city' class = 'form-control'>
            <?php while($row = mysqli_fetch_array($res)):?>
            <option value = "<?php echo $row[0]?>"><?php echo $row[1]. " : ".$row[3]?></option>
            <?php $city_sel[$row[0]] = $row[2];?>
            
            <?php endwhile; mysqli_free_result($res)?>

        </select>            
            <input type = 'text' name = 'hotel' placeholder = 'Отель'>
            <input type = 'text' name = 'cost' placeholder = 'Цена'>
            <input type = 'number' name = 'stars' placeholder = 'Количество звезд'>
            <textarea name = 'info'></textarea>

        <div class="form-group">
            <button type="submit" name='add_hotel' class='btn btn-info'>Добавить</button>
            <button type="submit" name='del_hotel' class='btn btn-danger'>Удалить</button>
        </div>
    </form>
    <?php
    if(isset($_POST['add_hotel'])) {
        $hotel = trim(htmlspecialchars($_POST['hotel']));
        $cost = trim(htmlspecialchars($_POST['cost']));
        $stars = trim(htmlspecialchars($_POST['stars']));
        $info = trim(htmlspecialchars($_POST['info']));
        

        if($hotel == '' || $cost == '' || $stars == '') {
            exit();
        }

        $cityId = $_POST['h_city'];
        $countryId = $city_sel[$cityId];

        $ins = 'INSERT INTO hotels(hotel, stars, cost, info, city_id, country_id) 
        VALUES ("'.$hotel.'", "'.$stars.'", "'.$cost.'", "'.$info.'", '.$cityId.', '.$countryId.')';
        
        mysqli_query($link, $ins);
        echo'<script>window.location=document.URL</script>';

    }

    if(isset($_POST['del_hotel']))
        {
            foreach($_POST as $key=>$value)
            {
                if(substr($key,0,2) == "ch") {
                    $hotelId = substr($key,2);                    
                    $del = 'DELETE FROM hotels WHERE id='.$hotelId;
                    mysqli_query($link, $del);

                }
            }

            echo'<script>window.location=document.URL</script>';
        }
    ?>
    </div>
    <div class="col-md-6 col-12">
        <form action ='index.php?page=4' method = 'POST' enctype = 'multipart/form-data'>
            <div class="form-group">
                <select name ='hotel_id' class = 'form-control'>
                    <?php
                    $sel = 'SELECT hotels.id, hotels.hotel, cities.city, countries.country FROM cities, countries, hotels
                    WHERE hotels.city_id = cities.id AND hotels.country_id = countries.id ORDER BY countries.country';
                    $res = mysqli_query($link, $sel);                    
                    ?>
                    <?php while($row = mysqli_fetch_array($res)):?>
                        <option value ='<?php echo $row[0]?>'><?php echo $row[1]. " : ".$row[2]. " : " .$row[3]?></option>
                    <?php endwhile; mysqli_free_result($res)?>
                </select>

            </div>
            <div class = 'form-group'>
                <input type = 'file' name = 'file[]' multiple accept = 'image/*' class = 'form-control'>
                <button type='submit' name='add_images' class='btn btn-info'>Добавить</button>
            </div>

        </form>
        <?php
        if(isset($_REQUEST['add_images'])) {

            
            foreach($_FILES['file']['name'] as $key=>$value) {

                if($_FILES['file']['error'][$key] !=0) {
                    echo '<script>alert("Ошибка загрузки изображения. Ошибка: '.$value.'")</script>';
                    continue;
                }

                if(move_uploaded_file($_FILES['file']['tmp_name'][$key], 'images/'.$value)) {
                    $ins = 'INSERT INTO images(hotel_id, image_path) VALUE('.$_REQUEST["hotel_id"].', "images/'.$value.'")';
                    mysqli_query($link, $ins);
                }

            } 

            
        }

        ?>
    </div>
</div>