<?php

    $tittle = "09 - Class Abstract";
    $descripcion = "A class that cannot be instantiated, only extended from.";

include 'template/header.php';
    echo '<section>';

abstract class DataBase {
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = '';
    protected $dbName = 'pokeadso';
    protected $conx;



}


    echo '</section>';

include 'template/footer.php';
