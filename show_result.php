<?php
@session_start();
$return = "<html lang='ru'><head><title>Result</title><meta charset='UTF-8'><link href=\"css/result.css\" rel=\"stylesheet\"></head><body>";

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
                <td>" . $cstart . " UTC</td>
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
