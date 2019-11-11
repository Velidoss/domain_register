<?php
include "db.php";
include "head.php";

?>

<?php
if (isset($_SESSION['logged_user'])) :?>
<div>
        Авторизован! <br>
    Привет <?php echo $_SESSION['logged_user']->login;  ?>!
    <hr>
    <p><a href="dom_reg.php">Зарегистрировать домен</a></p>
    <a href="logout.php">Выйти</a>
</div>

<?php else:?>

<body>
<div class="banner">
    <div class="logo">

    </div>
    <div class="heading">
        <h1>Зарегистрировать доменное имя?</h1>
        <p>для начала зарегистрируйте аккаунт!</p>
    </div>
    <div class="button">
        <button class="button__action">
            <a href="reg.php">Зарегистрировать</a> 
        </button>
        <button class="button__action">
            <a href="log.php">Войти</a> 
        </button>
    </div>
</div>


</body>
</html>
<?php
    endif;
?>
