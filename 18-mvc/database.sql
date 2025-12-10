DROP DATABASE IF EXISTS pokeadso;
CREATE DATABASE pokeadso;
USE pokeadso;

CREATE TABLE trainers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE pokemons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    strength INT,
    speed INT,
    accuracy INT,
    trainer_id INT,
    FOREIGN KEY (trainer_id) REFERENCES trainers(id) ON DELETE SET NULL
);

INSERT INTO trainers (name) VALUES 
('Ash Ketchum'), 
('Misty'), 
('Brock');

INSERT INTO pokemons (name, type, strength, speed, accuracy, trainer_id) VALUES 
('Pikachu', 'Electric', 55, 90, 100, 1),
('Charizard', 'Fire', 84, 100, 85, 1),
('Starmie', 'Water', 75, 115, 100, 2),
('Onix', 'Rock', 45, 70, 90, 3);
