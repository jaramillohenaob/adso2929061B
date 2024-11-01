<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Multiplicar</title>
</head>
<body>
    <h1>Tabla de Multiplicar</h1>
    <h3>for</h3>
    <p>
    <?php
    for ($f = 2; $f <= 20; $f += 2) {
        echo "2 x " . ($f / 2) . " = $f<br>";
    }
    ?>
    </p>
    <h3>while</h3>
    <p>
    <?php
    $f = 2;
    while ($f <= 20) {
        echo "2 x " . ($f / 2) . " = $f<br>";
        $f += 2;
    }
    ?>
    </p>
    <h3>do/while</h3>
    <p>
    <?php
    $f = 2;
    do {
        echo "2 x " . ($f / 2) . " = $f<br>";
        $f += 2;
    } while ($f <= 20);
    ?>
    </p>  
</body>
</html>



