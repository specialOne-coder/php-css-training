<?php

    try {
        $bd = new PDO("mysql:host=localhost;dbname=tpdb;charset=utf8","root","ferdio8918");
        $bd->setAttribute(PDO::ATTR_CASE , PDO::CASE_LOWER);
        $bd->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    } catch (EXCEPTION $th) {
        echo'Erreur'.$th;
    }

?>