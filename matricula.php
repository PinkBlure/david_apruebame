<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <label for="matricula">Dame una matrícula formato 1234AAA: </label>
        <input name='matricula' id="matricula" type="text" required>
        <input type="submit" value="¿Es válida?">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            esValido();
        }

        function esValido() {
            $matricula =  $_POST['matricula'];

            if (strlen($matricula) != 7) {
                echo "No es válida, no tiene 7 caractéres.";
            } elseif (preg_match("/[aeiouAEIOU]/", $matricula) == 1) {
                echo "No es válida, tiene vocales.";
            } elseif (preg_match("/[a-z]/", $matricula) == 1) {
                echo "No es válida, tiene consonantes minúsculas.";
            } elseif (preg_match("/\d{4}[A-Z]{3}/", $matricula) == 1) {
                echo "Esta matrícula si es válida.";
            } else {
                echo "No es válida, no sigue el formato 1234AAA.";
            }
        }
    ?>
</body>
</html>
