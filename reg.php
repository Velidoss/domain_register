<?php
    
    require "db.php";
    require "head.php";
    $data = $_POST;
    //do_reg - имя кнопки отправки 
    if (isset($data['do_reg']))
    {
        //массив для ошибок
        $errors = array();
        //здесь регистрируем
        if (trim($data['login']) == '')
        {
            $errors[] = 'Введите логин';
        }
        if (trim($data['email']) == '')
        {
            $errors[] = 'Введите e-mail';
        }

        if ($data['pass'] == '')
        {
            $errors[] = 'Введите пароль!';
        }

        if ($data['cpass'] != $data['pass'])
        {
            $errors[] = 'Повторный пароль введен неверно!';
        }
        //проверка на наличие пользователя с таким же логином или email-ом 
        if (R::count('users', "login = ?", array($data['login'])) > 0 )
        {
            $errors[] = 'Пользователь с таким логином уже существует!';
        }
        if (R::count('users', " email=?", array( $data['email'])) > 0 )
        {
            $errors[] = 'По этому email-у уже регистрировались!';
        }

        if (! empty($errors))
        {
            //если нету ошибок - то вносим пользователя в бд
            //redbean сам создает таблицу 
            $user = R::dispense('users');
            $user->login = $data['login'];
            $user->email = $data['email'];
            //шифруем пароль с помощью Bcrypt
            $user->password = password_hash($data['pass'], PASSWORD_DEFAULT);
            R::store($user);
            echo '<div style="color:green;" >Вы зарегистрированы!</div>';
        }else
        {
            echo '<div style="color:red;" >'.array_shift($errors).'</div>';
        }

    }

?>

<body>
    <div class="banner">
        <div class="register">
            <form action="reg.php" method="post" class="register-form">
                <h3>Регистрация</h3>
                <label for="register-form__login" >Логин</label>
                <input name="login" type="text" class="register-form__login" value="<?php echo @$data["login"]?>">
                <label for="register-form__login">Электронная почта</label>
                <input name="email" type="email" class="register-form__email" value="<?php echo @$data["email"]?>">
                <label for="register-form__login">Пароль</label>
                <input name="pass" type="password" class="register-form__pass">
                <label for="register-form__login">Повторите пароль</label>
                <input name="cpass" type="password" class="register-form__cpass" > 
                <button name="do_reg" type="submit" class="button__register"> Зарегистрироваться! </button>
            </form>
            <p>Уже зарегистрировался? <a href="log.php">Заходи!</a></p>

        </div>
    </div>
</body>

</html>