<?php
@session_start();

$start = microtime(true); // начало времени работы скрипта
$startdate = date("H:i:s");

$in = false;

$return = "<html lang='ru'><head><meta charset='UTF-8'><link href=\"result.css\" rel=\"stylesheet\"></head><body>";

$x = $_GET['x'];
$y = $_GET['y'];
$r = $_GET['r'];

$y = str_replace(",", ".", $y); // приводим число к нормальному виду с точкой

$correct = is_numeric($x) && is_numeric($y) && is_numeric($r);

if ($correct) {
    if ($x >= 0 && $y >= 0 && $x <= $r / 2 && $y <= $r) {
        $in = true;
    } elseif ($x <= 0 && $y >= 0 && pow($x, 2) + pow($y, 2) <= pow($r / 2, 2)) {
        $in = true;
    } elseif ($x <= 0 && $y <= 0 && $y >= -2 * $x - $r) {
        $in = true;
    }
}

$return .= "
<table>
    <tr>
        <th>X</th>
        <th>Y</th>
        <th>R</th>
        <th>Начало работы</th>
        <th>Время работы</th>
        <th>Реузльтат</th>
    </tr>
";

$end = microtime(true); // конец времени работы скрипта
$d = $end - $start;

$current = array(
    "correct" => $correct,
    "x" => $x,
    "y" => str_replace(".", ",", $y), // обратно к виду с запятой
    "r" => $r,
    "start_time" => $startdate,
    "work_time" => $d,
    "in" => $in
);

@array_push($_SESSION['arr'], $current);

for ($i = sizeof($_SESSION['arr']) - 1; $i >= 0; $i--) {
    if ($_SESSION['arr'][$i]["correct"]) {
        $cx = $_SESSION['arr'][$i]["x"];
        $cy = $_SESSION['arr'][$i]["y"];
        $cr = $_SESSION['arr'][$i]["r"];
        $cstart = $_SESSION['arr'][$i]["start_time"];
        $cwork = $_SESSION['arr'][$i]["work_time"];
        $cin = "Не попала";
        if ($_SESSION['arr'][$i]['in']) {
            $cin = "Попала";
        }
        $return .= "
            <tr>
                <td>" . $cx . "</td>
                <td>" . $cy . "</td>
                <td>" . $cr . "</td>
                <td>" . $cstart . "</td>
                <td>" . $cwork . "</td>
                <td>" . $cin . "</td>
            </tr>
        ";
    } else {
        $return .= "<tr><td colspan='6'><b>Неверные аргументы</b></td></tr>";
    }
}

$return .= "</table></body></html>";
echo $return;
