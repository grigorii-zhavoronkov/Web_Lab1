<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
$hide = false;
$counter = 2;

if (!is_null($_GET['refresh']) && $_GET['refresh'] == 1) {
    $_SESSION['arr'] = null;
    $hide = true;
    header("Location: index.php");
} elseif (is_null($_SESSION['arr']) || sizeof($_SESSION['arr']) == 0) {
    $_SESSION['arr'] = array();
    $hide = true;
} else {
    $counter += sizeof($_SESSION['arr']);
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лаба 1</title>
    <!-- Подключение css -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/result.css" rel="stylesheet">
    <!-- Подключение JS -->
    <script type="text/javascript" src="js/form_handler.js"></script>
    <script type="text/javascript" src="js/result_shower.js"></script>
    <script type="text/javascript" src="js/canvas_drawer.js"></script>
</head>
<body onload="cl(); loadCanvas(); validateCounter(<?php print($counter); ?>); resizeIframe()">
<!-- Шапка -->
<div class="content">
    <div class="header block">
        <h1>Жаворонков Григорий Игоревич</h1>
        <h3>Группа: P3202</h3>
        <h3>Вариант: 202008</h3>
    </div>
    <div class="container block">
        <p>Введите X, Y, R в полях ниже и узнайте, попала ли точка в фигуру, сгенерированную генератором генерируемых вариантов</p>
        <form id="form" action="result.php" method="get" target="result">
            <div id="X" class="prop">
                <span class="property">X</span>
                <span id="x_buttons">
                    <button id="x-4" type="button" onclick="chooseX(-4)">-4</button>
                    <button id="x-3" type="button" onclick="chooseX(-3)">-3</button>
                    <button id="x-2" type="button" onclick="chooseX(-2)">-2</button>
                    <button id="x-1" type="button" onclick="chooseX(-1)">-1</button>
                    <button id="x0" type="button" onclick="chooseX(0)">0</button>
                    <button id="x1" type="button" onclick="chooseX(1)">1</button>
                    <button id="x2" type="button" onclick="chooseX(2)">2</button>
                    <button id="x3" type="button" onclick="chooseX(3)">3</button>
                    <button id="x4" type="button" onclick="chooseX(4)">4</button>
                </span>
                <input id="X_input" name="x" class="hidden" hidden="true">
            </div>
            <div id="Y" class="prop">
                <span class="property">Y</span>
                <input id="Y_input" oninput="validateY()" name="y" placeholder="(-5 ... 3)" autocomplete="off">
            </div>
            <div id="R" class="prop">
                <span class="property">R</span>
                <span id="r_buttons">
                    <button id="r1" type="button" onclick="chooseR(1)">1</button>
                    <button id="r2" type="button" onclick="chooseR(2)">2</button>
                    <button id="r3" type="button" onclick="chooseR(3)">3</button>
                    <button id="r4" type="button" onclick="chooseR(4)">4</button>
                    <button id="r5" type="button" onclick="chooseR(5)">5</button>
                </span>
                <input id="R_input" name="r" class="hidden" hidden="true">
            </div>
            <button type="submit" id="submit" disabled onclick="drawPoint(); showResult(); resizeIframe()">Чекнуть</button>
        </form>
        <canvas width="300" height="300" id="canvas"></canvas>
    </div>
    <div id="result" class="block <?php if ($hide) { print("hidden"); }?>">
        <iframe src="show_result.php" name="result" frameBorder="0" seamless scrolling="no" id="iframe"></iframe>
        <a href="index.php?refresh=1">Начать заново</a>
    </div>
</div>
</body>
</html>