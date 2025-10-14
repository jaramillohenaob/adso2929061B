<?php

    $tittle = "25 - Challenges Dates";
    $descripcion = "Form for dates";

include 'template/header.php';
    echo '<section>';
 ?>

    <h2 style="text-align: center;">Formulario</h2>
    <div style="text-align: center;">
        <form action="" method="post">
            <label for="date1" style="display: inline-block; margin-bottom: 10px; font-weight: bold; color: #333;">Ingrese su fecha de cumpleaños:</label>
            <br><br>
            <input type="date" id="date1" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;" name="date1" required>
            <br><br>
            <input type="submit" value="Calcular Diferencia" style="padding: 10px 20px; background-color: blue; color: white; border: none; border-radius: 5px; cursor: pointer;">
        </form>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date1'])) {
        $date1 = $_POST['date1'];

        if (!empty($date1)) {
            $fechaNacimiento = new DateTime($date1);
            $fechaActual = new DateTime();
            $diferencia = $fechaActual->diff($fechaNacimiento);
            $edad = $diferencia->y;
            echo "<h3 style='margin-top: 20px; color: green;'>Tienes $edad años.</h3>";
        } else {
            echo "<h3 style='margin-top: 20px; color: red;'>Por favor, ingresa una fecha válida.</h3>";
        }
    }
    echo '</section>';

include 'template/footer.php'; ?>

