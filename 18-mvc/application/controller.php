<?php 

    class Controller {
        public $load;
        public $model;

        public function __construct() {
            $this->load  = new Load;
            $this->model = new Model;

            $this->handleRequest();

        }

        private function handleRequest() {
            $request_uri = $_SERVER['REQUEST_URI'];
            $parsed_url  = parse_url($request_uri);
            $path        = trim($parsed_url['path'] ?? '', '/'); 

            if ($path && !isset($_GET['method'])) {
                $segments = explode('/', $path);
                $method   = $segments[0] ?? 'index';
                $id       = $segments[1] ?? null;
            } else {
                $method = $_GET['method'] ?? 'index';
                $id     = $_GET['id'] ?? null;
            }

            switch($method) {
            case 'create':
                $this->create();
                break;
            case 'show':
                $this->show($id);
                break;
            case 'update':
                $this->update($id);
                break;
            case 'delete':
                $this->delete($id);
                break;
            default:
                $this->index();
            }
        }
        
        private function index() {
            $pokemons = $this->model->listPokemon();
            $this->load->view('welcome.php', $pokemons);
        }

        private function store() {
            $name = trim($_POST['name'] ?? '');
            $type = trim($_POST['type'] ?? '');
            $strenght = trim($_POST['strenght'] ?? '');
            $stamina = trim($_POST['stamina'] ?? '');
            $speed = trim($_POST['speed'] ?? '');
            $accuracy = trim($_POST['accuracy'] ?? '');
            $trainer_id = trim($_POST['trainer_id'] ?? '');

            if (!empty($name) && !empty($type) && !empty($trainer_id)) {
                $this->model->createPokemon($name, $type, $strenght, $stamina, $speed, $accuracy, $trainer_id);
            }
            header('location: /');
            exit();
        }

        public function create() {
            $trainers = $this->model->listTrainer();
            $this->load->view("create.php", $trainers);
        }

        private function show($id) {
            $pokemon = $this->model->showPokemons($id);
            $this->load->view("show.php", $pokemon);
        }

        public function update($id) {
            $this->model->updatePokemon(
                $id,
                $_POST['name'],
                $_POST['type'],
                $_POST['strenght'],
                $_POST['stamina'],
                $_POST['speed'],
                $_POST['accuracy'],
                $_POST['trainer_id']
            );
            $this->load->view("edit.php", ['pokemon' => $id]);
        }

        public function delete($id) {
            $this->model->deletePokemon($id);
        }
        
    }