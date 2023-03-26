<?php

function connect($host = 'localhost', $name = 'test', $pass ='123456', $db = 'hotels')
{
    $link= mysqli_connect($host, $name, $pass, $db) or die('Ошибка соединения');
    mysqli_query($link, 'SET NAMES "utf8"');
    return $link;
}

function registered ($login, $pass, $email)
{
    //убираем пробелы и спец символы
    $login = trim(htmlspecialchars($login));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));

    //проверка на пустые строки

    if($login == "" || $pass == "" || $email == "") {
        echo '<h4 class = "text-danger">Необходимо заполнить все поля!</h4>';
        return false;
    }

    //проверка пароля и логина на длину строки от 3 до 30 символов

    if(strlen($login) < 3 || strlen($login) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
        echo '<h4 class = "text-danger">Количество символов должно быть от 3 до 30!</h4>';
        return false;
    }

    $ins = 'INSERT INTO users(login, password, email, role_id) 
    VALUES ("'.$login.'", "'.password_hash($pass, PASSWORD_DEFAULT).'", "'.$email.'", 2)';

    mysqli_query(connect(), $ins);
    return true;
}

function login ($log, $pass) {

    $log = trim(htmlspecialchars($log));
    $password = trim(htmlspecialchars($pass));    
    
    if ($log== '' || $password =='') {
        echo '<h4 class = "text-danger">Необходимо заполнить все поля!</h4>';
        return false;
    };
    

    $passhash = md5($password);

    $sel = "SELECT * FROM users WHERE login = '$log' AND password ='$passhash'";
    
    $res = mysqli_query(connect(), $sel); 

    if (mysqli_num_rows($res) > 0) {

            $res = mysqli_fetch_assoc ($res);
            $_SESSION['user'] = $res['login'];
            $_SESSION['users_id'] = $res['id'];
            
            
            if($res['role_id'] == 1) {
                $_SESSION['admin'] = $res['login'];
            }
            else {
                unset($_SESSION['admin']);
            }          
            return true;    

        }
    else {
        
        return false;        
    }      
}

function logout () {
    unset($_SESSION['user']);
    unset($_SESSION['users_id']);
    if($_SESSION['admin']) {
        unset($_SESSION['admin']);
    }
    header("Location: ../index.php");
}
?>