<?php
    
    require "db.php";
    require "head.php";
    $data = $_POST;


    if (isset($data['do_log']) )
    {
        $errors = array();
        $user = R::findOne('users', 'login = ?', array($data['login']));
        if ($user)
        {
            //если логин существует, проверяем есть ли такой пароль в базе данных
            if( password_verify($data['pass'], $user->password)
            ){
                //все хорошо, логиним пользователя
                $_SESSION['logged_user'] = $user;
                echo '<div style="color:green;" >Вы авторизованы!</br> Можете перейти на <a href="/">главную</a></div>';
            }else
            {
                $errors[] = 'неверно введен пароль :(';
            }
        }else
        {
            $errors[] = 'Потзователь с таким логином не найден :(';
        }
        if (! empty($errors))
        {
            echo '<div style="color:red;" >'.array_shift($errors).'</div>';
        }
    }

?>

<body>
    <div class="banner">
        <div class="login">
            <form action="log.php" method="post" class="login-form">
                <h3>Вход</h3>
                <label for="login-form__login">Логин</label>
                <input name="login" type="text" class="register-form__login">
                <label for="login-form__login">Пароль</label>
                <input name="pass" type="password" class="register-form__pass">
                <button name="do_log" type="submit" class="button__login"> Войти </button>
            </form>
            <p>Еще не зарегистрировался? <a href="reg.php">Тебе сюда!</a></p>
        </div>
    </div>
</body>

</html>