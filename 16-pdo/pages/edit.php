<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu mejor amigo en casa - Edit</title>
    <link rel="stylesheet" href="<?=$css?>/master.css">
</head>
<body>
    <main class="edit">
        <header>
            <h2>Modificar Mascota</h2>
            <a href="dashboard.html" class="back"></a>
            <a href="index.html" class="close"></a>
        </header>
        <form action="edit.php" method="post">
            <input type="hidden" name="id" value="<?=$pet['id']?>">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" value="<?=$pet['name']?>" required>
            </div>
            <div class="form-group">
                <label for="species">Especie</label>
                <input type="text" name="species" id="species" value="<?=$pet['species']?>" required>
            </div>
            <div class="form-group
">
                <label for="breed">Raza</label>
                <input type="text" name="breed" id="breed" value="<?=$pet['breed']?>" required>
            </div>
            <div class="form-group">
                <label for="photo">Foto</label>
                <input type="file" name="photo" id="photo" accept="image/*">
            </div>
            
            <button class="update">Modificar</button>
        </form>
    </main>
</body>
</html>