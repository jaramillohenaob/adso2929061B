<form action="/pokemon/update/<?= $data['id'] ?>" method="POST">
    Name: <input type="text" name="name" value="<?= $data['name'] ?>"><br>
    Type: <input type="text" name="type" value="<?= $data['type'] ?>"><br>
    Strength: <input type="number" name="strength" value="<?= $data['strength'] ?>"><br>
    Speed: <input type="number" name="speed" value="<?= $data['speed'] ?>"><br>
    Accuracy: <input type="number" name="accuracy" value="<?= $data['accuracy'] ?>"><br>
    Trainer ID: <input type="number" name="trainer_id" value="<?= $data['trainer_id'] ?>"><br>
    <button type="submit">Actualizar</button>
</form>
