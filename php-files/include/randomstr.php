<?php
    function rndStr($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $result = '';
        for ($i = 0; $i < 5; $i++) $result .= $characters[mt_rand(0, 61)];
        return $result;
    }
 ?>
