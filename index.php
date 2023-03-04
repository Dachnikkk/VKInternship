<?php

include "TimeToWordConverter.php";
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Алгоритм для конвертации цифрового представления времени в словесное</title>
</head>
<body>
<?php


$converter = new TimeToWordConverter();
// echo $converter->convert(7, 0) . "<br>";   // Семь часов
// echo $converter->convert(7, 1) . "<br>";   // Одна минута после семи
// echo $converter->convert(7, 3) . "<br>";   // Три минуты после семи
// echo $converter->convert(7, 12) . "<br>";  // Двенадцать минут после семи
// echo $converter->convert(7, 15) . "<br>";  // Четверть восьмого
// echo $converter->convert(7, 22) . "<br>";  // Двадцать две минуты после семи
// echo $converter->convert(7, 30) . "<br>";  // Половина восьмого
// echo $converter->convert(7, 35) . "<br>";  // Тридцать пять минут до восьми
// echo $converter->convert(7, 41) . "<br>";  // Девятнадцать минут до восьми
// echo $converter->convert(7, 56) . "<br>";  // Четыре минуты до восьми
// echo $converter->convert(7, 59) . "<br>";  // Одна минута до восьми.
for ($i = 1; $i <= 12; $i++) {
    for ($j = 1; $j <= 59; $j++) {
        echo sprintf("%s:%s - ", str_pad($i,2,"0", STR_PAD_LEFT), str_pad($j,2,"0", STR_PAD_LEFT)).$converter->convert($i, $j) . "<br>";
    }
}
?>
</body>
</html>
