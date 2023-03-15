<h2 class='py-3'>Консоль администратора</h2>

<div class="row">
    <div class="col-md-6 col-12">
        <?php
        $link = connect();
        $sel = 'SELECT * FROM countries ORDER BY country';
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
    <div class="col-md-6 col-12"></div>
    <div class="col-md-6 col-12"></div>
    <div class="col-md-6 col-12"></div>
</div>