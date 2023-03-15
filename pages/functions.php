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
    VALUES ("'.$login.'", "'.md5($pass).'", "'.$email.'", 2)';

    mysqli_query(connect(), $ins);
    return true;
}

?>