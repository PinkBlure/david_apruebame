<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario 2º DAW</title>
</head>
<body>
    <?php
        // Definimos como horario por defecto el de canarias.
        date_default_timezone_set("Atlantic/Canary");

        // Definicion de modulos con sus respectivos profesores y aulas.
        $modulos = [
            "DSW" => ["David Pérez Lorenzo", "Planta 2, Aula 14"],
            "DOR" => ["Badel del Cristo Hernández Hernández", "Planta 2, Aula 14"],
            "EMR" => ["Carolina Vizcano Marrero", "Planta 0, Aula Coworking 2"],
            "DPL" => ["Alicia Acerina Pérez Mateo", "Planta 2, Aula 14"],
            "DEW" => ["Marta Elena Domínguez Santana", "Planta 2, Aula 14"]
        ];

        // Definicion de horario
        $horario = [
            "Lunes" => ["DSW", "DSW", "DOR", "EMR", "EMR", "DOR"],
            "Martes" => ["DOR", "DOR", "DSW", "DSW", "DPL", "DPL"],
            "Miércoles" => ["EMR", "DEW", "DEW", "DEW", "DSW", "DSW"],
            "Jueves" => ["DEW", "DEW", "DOR", "DOR", "DPL", "DPL"],
            "Viernes" => ["DPL", "DPL", "DEW", "DEW", "DSW", "DSW"]
        ];

        // Definicion de horas para modulos.
        $horas = [
            0 => [800, 855],
            1 => [855, 950],
            2 => [950, 1045],
            "R" => [1045, 1115],
            3 => [1115, 1210],
            4 => [1210, 1305],
            5 => [1305, 1400]
        ];

        // Definicion de hora y dia especifico a sacar.
        $horaElegida = 800;
        $diaElegido = "Lunes";

        // Generar respuesta con hora y dia especificados manualmente.
        sacarQueToca($horaElegida, $diaElegido, $horas, $horario, $modulos);

        echo "<br>";

        // Generar respuesta con hora y dia actual.
        sacarQueToca(date("hi"), traducirDias(date("l")), $horas, $horario, $modulos);

        // Funcion para generar el resultado
        function sacarQueToca($horaIntroducida, $diaIntroducido, $horas, $horario, $modulos){
            // Comprobamos que no es fin de semana.
            if(array_key_exists($diaIntroducido, $horario)){
                // Comprobar entrar en horario lectivo.
                if(sacarHoras($horaIntroducida, 800, 1400)){
                    // Sacamos la hora(1ª, 2ª...) de la hora que se nos introduce.
                    foreach($horas as $hora => [$horaMinima, $horaMaxima]){
                        // Comprobamos que no es recreo.
                        if(sacarHoras($horaIntroducida, $horaMinima, $horaMaxima) && $hora !== "R"){
                            // Individualizamos los modulos del dia.
                            foreach($horario as $dia => $moduloDia){
                                // Seleccionamos el dia en cuestion.
                                if ($dia == $diaIntroducido){
                                    echo "Hoy dia $dia, toca el modulo " . $moduloDia[$hora] . " con el profesor " . $modulos[$moduloDia[$hora]][0] . " en la " . $modulos[$moduloDia[$hora]][1] . ".";
                                }
                            }
                        } elseif (sacarHoras($horaIntroducida, $horaMinima, $horaMaxima) && $hora == "R") {
                            echo "Estas en el recreo.";
                        }
                    }
                } else {
                    echo "No te encuentras en horario lectivo.";
                }
            } else {
                echo "Estas en fin de semana.";
            }
        }
        // Funcion para traducir de ingles a español los dias.
        function traducirDias($diaIngles){
            switch ($diaIngles) {
                case "Monday":
                    return "Lunes";
                    break;
                case "Tuesday":
                    return "Martes";
                    break;
                case "Wednesday":
                    return "Miercoles";
                    break;
                case "Thursday":
                    return "Jueves";
                    break;
                case "Friday":
                    return "Viernes";
                    break;
            }
        };

        // Funcion para sacar si una hora se encuentra entre un rango.
        function sacarHoras($horaABuscar, $horaMinima, $horaMaxima){
            if($horaABuscar >= $horaMinima && $horaABuscar <= $horaMaxima){
                return true;
            } else {
                return false;
            }
        };
    ?>
</body>
</html>