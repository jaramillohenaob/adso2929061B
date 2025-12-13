<?php 

class Model extends Database {
    protected $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function listPokemon() {
        $stmt = $this->db->query("SELECT * FROM pokemons");
        return $stmt->fetchAll();
    }

    public function listTrainer() {
        $stmt = $this->db->query("SELECT * FROM trainers");
        return $stmt->fetchAll();
    }

    public function showPokemons($id) {
        $id = intval($id);

        $sql = "SELECT p.*, t.name AS trainer_name
                FROM pokemons p
                LEFT JOIN trainers t ON p.trainer_id = t.id
                WHERE p.id = $id";

        $stmt = $this->db->query($sql);
        return $stmt->fetch();
    }


    public function createPokemon($name, $type, $strenght, $stamina, $speed, $accuracy, $trainer_id) {
        $stmt = $this->db->prepare("INSERT INTO pokemons (name, type, strenght, stamina, speed, accuracy, trainer_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $type, $strenght, $stamina, $speed, $accuracy, $trainer_id]);
    }

    public function deletePokemon($id) {
        $stmt = $this->db->prepare("DELETE FROM pokemons WHERE id = ?");
        return $stmt->execute([intval($id)]);
    }

    public function updatePokemon($id, $name, $type, $strenght, $stamina, $speed, $accuracy, $trainer_id) {
    $stmt = $this->db->prepare("
        UPDATE pokemons SET name=?, type=?, strenght=?, stamina=?, speed=?, accuracy=?, trainer_id=? 
        WHERE id=?
    ");
    return $stmt->execute([$name, $type, $strenght, $stamina, $speed, $accuracy, $trainer_id, $id]);
}
}