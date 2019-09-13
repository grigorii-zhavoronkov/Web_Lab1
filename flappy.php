<?php
session_start();

if (!(!is_null($_SESSION['flappy']) && $_SESSION['flappy'] == 1)) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Захотели сломать мою лабу?</title>
    <script src="js/flappy.js"></script>
    <style>
        .hidden {
            width: 0;
            height: 0;
            display: none;
            visibility: hidden;
        }
    </style>
</head>
<body>
<h3>Пройдите flappy bird до 10 очков и вернитесь на главную страницу</h3>
<p>Считайте это наказанием за то, что вы сломали мою лабу</p>
<p><b>Управление: </b><br><b>Пробел</b> - прыжок</p>
<canvas id="canvas" width="400" height="600"></canvas>
<a href="index.php?success=1" class="hidden" id="back">Вернуться</a>
</body>
<script>
    setup();
</script>
</html>