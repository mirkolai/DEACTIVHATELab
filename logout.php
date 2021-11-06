<?php
if (isset($_SERVER['HTTP_COOKIE'])) {//do we have any
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);//get all cookies 
    foreach($cookies as $cookie) {//loop
        $parts = explode('=', $cookie);//get the bits we need
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);//kill it
        setcookie($name, '', time()-1000, '/');//kill it more
    }
}
session_destroy();

header("Location:index.php?message=Tutti i cookies rimossi");

?>
