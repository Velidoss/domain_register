<?php

require "libs/rb-mysql.php";
//подключение к базе данных
R::setup( 'mysql:host=localhost;dbname=db_name',
'username', 'password' ); 

session_start();