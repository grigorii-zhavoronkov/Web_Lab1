<?php
@session_start();

$start = microtime(true); // начало времени работы скрипта
$startdate = date("H:i:s");

$in = false;

$x = (int)$_GET['x'];
$y = $_GET['y'];
$r = (int)$_GET['r'];

$y = str_replace(",", ".", $y); // приводим число к нормальному виду с точкой

$correct = is_int($x) && is_numeric($y) && is_int($r)
    && ($x >= -4) && ($x <= 4) && ($r >= 1) && ($r <= 5) && ($y > -5) && ($y < 3);

if ($correct) {
    if ($x >= 0 && $y >= 0 && $x <= $r / 2 && $y <= $r) {
        $in = true;
    } elseif ($x <= 0 && $y >= 0 && pow($x, 2) + pow($y, 2) <= pow($r / 2, 2)) {
        $in = true;
    } elseif ($x <= 0 && $y <= 0 && $y >= -2 * $x - $r) {
        $in = true;
    }
}

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

include_once "show_result.php";
