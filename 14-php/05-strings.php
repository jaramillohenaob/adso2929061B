<?php

    $tittle = "04 - Variables";
    $descripcion = "How to assing values";

include 'template/header.php';
    echo '<section>';

    $string1 = "Lorem ipsum dolor ";
    $string2 = "sit amet consectetur...";

    echo "<p>" . $string1 .' '. $string2 . "</p>";
    echo "Character length: " . strlen($string1 . $string2);

include 'template/footer.php';
