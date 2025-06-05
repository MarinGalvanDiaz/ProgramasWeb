<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../Style/StyleForm.css">
    <title>Calificar</title>
</head>
<body>
<div class="Contenedor">
    <div class="titulo">
    <h1>Calificar</h1>
    </div>
    <div class="formu">
    <form method="post" action="../index.php" enctype="multipart/form-data" name="formu">
        <label for="experiencia">
            Dame tu reseña
            <input type="text" class="texto" name="texto" id="textp" size="30" maxlength="200" required>
        </label>
        <label for="calif">
            Calificación
            <select id="calif" name="calif" required>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </label>
        <label for="aspecto">
            Defina el aspecto del platillo
        </label>
        <label for="aspecto">
            Malo
            <input type="radio" name="aspecto" id="malo" value="malo" required>
        </label>
        <label for="aspecto">
            Regular
            <input type="radio" name="aspecto" id="regular" value="regular"  required>
        </label>
        <label for="aspecto">
            Bueno
            <input type="radio" name="aspecto" id="bueno" value="bueno" required>
        </label>
        <label for="archivo">
            Insertar foto
            <input type="file" name="archivo" value="Subir foto" accept="image/*" required>
        </label>
        <label for="submit">
            <input type="submit" name="submit" value="Enviar" id="submit">
        </label>

    </form>
    </div>
</div>

</body>
</html>