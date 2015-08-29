<?php

include "../classes/Login.php";

$loginCheck = new Login();

$test = $loginCheck->loginWithPostData($_POST['user_name'], $_POST['user_password'], $_POST['user_rememberme']);

echo($_POST['user_name'].$_POST['user_password'].$_POST['user_rememberme'].' - '.$test);