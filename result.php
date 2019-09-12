<?php
@session_start();

if (!is_null($_SESSION['flappy']) && $_SESSION['flappy'] == 1) {
    header("Location: flappy.php");
}

$start = microtime(true); // начало времени работы скрипта
$startdate = date("H:i:s");

$in = false;

$x = (int)$_GET['x'];
$y = $_GET['y'];
$r = (int)$_GET['r'];

$y = str_replace(",", ".", $y); // приводим число к нормальному виду с точкой

$correct = in_array($_GET['x'], ['-4', '-3', '-2', '-1', '0', '1', '2', '3', '4']) &&
    in_array($_GET['r'], ['1', '2', '3', '4', '5']) && is_int($x) && is_numeric($y) && is_int($r) &&
    ($x >= -4) && ($x <= 4) && ($r >= 1) && ($r <= 5) && ($y > -5) && ($y < 3);

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

array_push($_SESSION['arr'], $current);

if (!$correct) {
    $_SESSION['flappy'] = 1;
    echo "<script>parent.document.location.href = 'flappy.php'</script>";
}

include_once "show_result.php";