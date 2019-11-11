<?php
    require 'db.php';
    require 'head.php';
    
    $data=$_POST;
    if (isset($data['do_dom_reg']))
    {
        $errors = array();
        if(R::count('domains', "domain_name = ?", $data['domain'])>0){
            $errors[] = 'Это доменное имя уже занято!';
        }
        
        if (!empty($errors)){
        $user = $_SESSION['logged_user'];
        $domain = R::dispense('domains');
        $domain->domain_name = $data['domain'];
        $domain->domain_master = $user;
        R::store($domain);
        echo '<div style="color:green;" >Домен зарегистрирован!</div>';
    }else{
        echo '<div style="color:red ;" >Недопустимое имя домена :с</div>';
    }

}
?>


<body>
    <div class="banner">
        <div class="dom_register">
            <form action="dom_reg.php" method="post" class="dom_register-form">
                <h3>Регистрация домена</h3>
                <label for="register-form__login" >Имя домена</label>
                <input name="domain" type="text" class="register-form__login">
                <button name="do_dom_reg" type="submit" class="button__register"> Зарегистрировать </button>
            </form>
        </div>
        <div class="">
            <button><a href="index.php">отмена</a></button>
        </div>
    </div>
</body>

</html>

