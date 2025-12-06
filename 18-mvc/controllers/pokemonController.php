<?php

class PokemonController {

    public $model;
    public $load;

    public function __construct() {
        $this->model = new Model();
        $this->load  = new Load();
    }

    public function index() {
        $pokemons = $this->model->listPokemon();
        $this->load->view("welcome.php", $pokemons);
    }

    public function create() {
        $this->load->view("create.php");
    }

    public function store() {
        $this->model->createPokemon(
            $_POST['name'],
            $_POST['type'],
            $_POST['strength'],
            $_POST['speed'],
            $_POST['accuracy'],
            $_POST['trainer_id']
        );
        header("Location: /pokemon/index");
    }

    public function edit($id) {
        $pokemon = $this->model->showPokemons($id);
        $this->load->view("edit.php", $pokemon);
    }

    public function show($id) {
        $pokemon = $this->model->showPokemons($id);
        $this->load->view("show.php", $pokemon);
    }

    public function update($id) {
        $this->model->updatePokemon(
            $id,
            $_POST['name'],
            $_POST['type'],
            $_POST['strength'],
            $_POST['speed'],
            $_POST['accuracy'],
            $_POST['trainer_id']
        );
        header("Location: /pokemon/index");
    }

    public function delete($id) {
        $this->model->deletePokemon($id);
        header("Location: /pokemon/index");
    }
}
