<?php 

    class Controller {
        public $load;
        public $model;

        public function __construct() {
            $this->load  = new Load;
            $this->model = new Model;

            $pokemons = $this->model->listPokemon();
            $this->load->view('welcome.php', $pokemons);

        }
    }