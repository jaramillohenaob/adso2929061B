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
    strenght INT DEFAULT 50,
    stamina INT DEFAULT 50,
    speed INT DEFAULT 50,
    accuracy INT DEFAULT 50,
    trainer_id INT,
    FOREIGN KEY (trainer_id) REFERENCES trainers(id) ON DELETE SET NULL
);

INSERT INTO trainers (name) VALUES 
('Ash Ketchum'), 
('Misty'), 
('Brock');

INSERT INTO pokemons (name, type, strenght, stamina, speed, accuracy, trainer_id) VALUES 
('Pikachu', 'Electric', 55, 60, 90, 100, 1),
('Charizard', 'Fire', 84, 78, 100, 85, 1),
('Starmie', 'Water', 75, 85, 115, 100, 2),
('Onix', 'Rock', 45, 50, 70, 90, 3);
