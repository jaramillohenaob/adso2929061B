<?php

    $tittle = "01 - Class";
    $descripcion = "lorem ipsum dolor sit amet";

include 'template/header.php';
    echo '<section>';

    class PlayList {
        # Attr
        public $artist;
        public $album;
        public $year;
        public $song;
        
        # Construct Method
        public function __construct($artist, $album, $year, $song = 'Happy Birthday') {
            $this->artist = $artist;
            $this->album = $album;
            $this->year = $year;
            $this->song = $song;
        }

    }

    $pl = new PlayList('Juanes', 'La camisa negra', 1994, 'La tierra');
    echo $pl->song;

    echo '</section>';

include 'template/footer.php';
