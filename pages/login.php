
<?php include_once('functions.php')?>
<h2 class = my-5>Войти на сайт</h2>

<?php if(!isset($_POST['login_btn'])): ?>
    <form action = 'index.php?page=5' method = 'POST'>
        <div class = 'form-group mb-3'>
            <label for = 'log'>Логин</label>
            <input type = 'text' class = 'form-control' name = 'log'>
        </div>
        <div class = 'form-group mb-3'>
            <label for = 'password'>Пароль</label>
            <input type = 'password' class = 'form-control' name = 'password'>
        </div>
        <button type = 'submit' name = 'login_btn' class= 'btn btn-success'>Вход</button>

    </form>

<?php else: ?>
    <?php if (login($_POST['log'], $_POST['password'])):?>
               <script>
            window.location = window.location.origin;
            </script>
            
    <?php endif; ?>
    <?php if (!login($_POST['log'], $_POST['password'])):?>            
               <script>
            window.location = window.location.origin;
            </script>            
    <?php endif; ?>  
<?php endif  ?>