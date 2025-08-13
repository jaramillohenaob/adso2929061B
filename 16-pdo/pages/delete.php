<?php
    include '../config/app.php';
    include '../config/database.php';
    include '../config/security.php';

    if($_GET) {
         $id = $_GET['id'];

         if(deletePet($id, $conx)) {
            $_SESSION['message'] = "La Mascota fue eliminada con exito!";
            unlink('../images/uploads/' . $id . '.png');
             echo "<script>window.location.replace('dashboard.php')</script>";
         }
    }