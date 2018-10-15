<?php
/**
 * Задание 1. Безопасность
 *
 * На сайте решили добавить форму, чтобы обычные пользователи могли оставлять свои комментарии.
 * При этом, нужно разрешить использовать простейшие HTML теги: <b/i/u>, <ul>, <ol>, <img>, <a>, <hr>.
 *
 * Проанализируйте и перечислите потенциальные проблемы в безопасности.
 * Напишите план алгоритма обработчика поля "комментарий", который бы обезопасил работу проекта.
 *
 *
 * Потенциальные проблемы:
 * 1) Внедрение javascript в атрибуты тегов. (XSS - межсайтовый скриптинг)
 * 2) SQL инъекции.
 *
 * План алгоритма обработчика поля "комментарий":
 * 1) Удаляем из строки запрещенные теги
 * 2) Проверяем, что у разрешенных тегов отсутствуют атрибуты, если таковые есть, то удаляем их. Исключение для <img> и <a>.
 * Для них разрешаем src и href соответственно.
 * 3) Делаем экранирование вставляемого в БД текста посредством подготовленны выражений либо для ручных запросов
 * посредством mysqli::real_escape_string/PDO::quote().
 */

?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Задание 1. Безопасность">
    <meta name="author" content="Смилик Анатолий">

    <title>Задание 1. Безопасность</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<img src="https://steemitimages.com/DQmchYRPbCSga5xzRQ1ids8WfmbdoCEdWdRuBrGzP8umiBa/XSS.png" onclick="location.replace('http://yandex.ru');">
<div style="max-width: 800px;">
    <h3>Задание 1. Безопасность</h3>
    На сайте решили добавить форму, чтобы обычные пользователи могли оставлять свои комментарии.
    При этом, нужно разрешить использовать простейшие HTML теги: <?= htmlspecialchars("<b/i/u>, <ul>, <ol>, <img>, <a>, <hr>.")?>

    Проанализируйте и перечислите потенциальные проблемы в безопасности.
    Напишите план алгоритма обработчика поля "комментарий", который бы обезопасил работу проекта.


    <h4>Потенциальные проблемы:</h4>
    1) Внедрение javascript в атрибуты тегов. (XSS - межсайтовый скриптинг)<br>
    2) SQL инъекции.

    <h4>План алгоритма обработчика поля "комментарий":</h4>
    1) Удаляем из строки запрещенные теги<br>
    2) Проверяем, что у разрешенных тегов отсутствуют атрибуты, если таковые есть, то удаляем их. Исключение для <?= htmlspecialchars("<img> и <a>")?>.
        Для них разрешаем src и href соответственно.<br>
    3) Делаем экранирование вставляемого в БД текста посредством подготовленны выражений либо для ручных запросов
        посредством mysqli::real_escape_string/PDO::quote().<br>
</div>
</body>
</html>