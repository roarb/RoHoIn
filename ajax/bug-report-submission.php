<?php
/**
 * Created by PhpStorm.
 * User: RMP2
 * Date: 6/14/2015
 * Time: 9:41 AM
 */

$description = $_POST['description'];
$url = $_POST['url'];
$userName = $_SESSION['user_name'];
$userId = $_SESSION['user_id'];
$userEmail = $_POST['user-email'];
$date = date("Y-m-d H:i:s",time());

$msg = 'Description: '.$description.'<br /><br />';
$msg .= 'URL: '.$url.'<br /><br />';
$msg .= 'Date: '.$date.'<br /><br />';
$msg .= 'User Name: '.$userName.'<br />User ID: '.$userId.'<br />User Email: '.$userEmail;

$headers = "From: rob@roho.in\r\n" ;
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "MIME-Version: 1.0";

mail("rhoehn24@gmail.com", "ROHO.IN Bug Report - ".$date, $msg, $headers);