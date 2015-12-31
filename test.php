<?php
/**
 * Created by PhpStorm.
 * User: rhoeh
 * Date: 12/26/2015
 * Time: 8:33 AM
 */

session_start();

$_SESSION['test'] = 'testing text in here';

var_dump($_SESSION);
