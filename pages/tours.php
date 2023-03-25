<?php $link = connect(); ?>

<h2 class='py-3'>Консоль администратора</h2>

<form action="index.php?page=1" method = 'POST'>
    <div class = 'row'>        
        <div class = 'col-md-6 col-12'>
            <div class="d-flex">
            <select name='country_id' class = 'form-control'>
                <?php
                $sel = 'SELECT * FROM countries ORDER BY country';
                $res = mysqli_query($link, $sel);
                ?>
                <?php while($row = mysqli_fetch_array($res)):?>
                    <option value = "<?php echo $row['id']?>"><?php echo $row['country']?></option>
                <?php endwhile; mysqli_free_result($res)?>
            </select>
            <button type = 'submit' name = 'sel_country' class = 'btn btn-info'>OK</button>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="d-flex">
                <select name='city_id' class = 'form-control'>
                    <?php
                    if(isset($_POST['country_id'])) {
                        $countryId  = $_POST['country_id'];
                        if($countryId == '') exit();

                        $sel = "SELECT * FROM cities WHERE country_id=".$countryId. " ORDER BY city";
                        $res = mysqli_query($link, $sel); ?>
                        <?php while($row = mysqli_fetch_array($res)):?>
                        
                        <option value= '<?php echo $row["id"]?>'><?php echo $row["city"]?></option>
                            
                        <?php endwhile; mysqli_free_result($res)?>
                    <?php
                    } 
                    ?>                  

                </select>
                <button type = 'submit' name = 'sel_city' class = 'btn btn-info'>OK</button>
            </div>
        </div>
            
        </div>
    </div>
</form>
<?php
if(isset($_POST['sel_city'])):
    $cityId = $_POST['city_id'];
    $sel = 'SELECT HO.id, HO.hotel, CO.country, CI.city, HO.cost, HO.stars FROM cities AS CI, countries AS CO, hotels AS HO 
    WHERE HO.country_id = CO.id AND HO.city_id = CI.id AND HO.city_id ='.$cityId;
    $res = mysqli_query($link, $sel);
    ?>
<table class = 'table table-striped my-5'>
    <thead>
        <tr>
            <td>Отель</td>
            <td>Страна</td>
            <td>Город</td>
            <td>Цена</td>
            <td>Звезды</td>
            <td>Ссылка</td>
        </tr>
    </thead>
    <thbody>
        <?php while($row = mysqli_fetch_array($res)):?>
            
            <tr>
                <td><?php echo $row[1]?></td>
                <td><?php echo $row[2]?></td>
                <td><?php echo $row[3]?></td>
                <td><?php echo $row[4]?></td>
                <td><?php echo $row[5]?></td>
                <td><a href ='<?php echo"pages/hotelinfo?hotel=".$row[0]?>'>Перейти</a></td>
            </tr>
        <?php endwhile; mysqli_free_result($res);?>

    </thbody>
</table>
<?php endif ?>