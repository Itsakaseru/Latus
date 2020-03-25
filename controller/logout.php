<?php

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        session_unset();
        session_destroy();
        setcookie('latus-userid', '', time()-60*60*24*90, '/', '', 0, 0);
        setcookie('latus-token', '', time()-60*60*24*90, '/', '', 0, 0);
        unset($_COOKIE['latus-userid']);
        unset($_COOKIE['latus-token']);
    }

?>