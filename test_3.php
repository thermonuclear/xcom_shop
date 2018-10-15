<?php
/**
 * Задание 3. Код
 * Необходимо написать функцию, которая получает на вход массив и определяет уровень вложенности полученного массива.
 * В случае если массив содержит цикл, например, через ссылку, функция должна вернуть false.
 */

//$a = [[2=>[4,5=>[4,5]],3],1];
//$a[2] = &$a;
//print_r($a);
//echo '<br>';
//var_dump(findArrayDepth($a));


/**
 * определение вложенности массива и наличия цикла в массиве.
*/
function findArrayDepth(array $array)
{
    static $maxLevel = 0;
    static $curLevel = 0;

    if ($maxLevel == 0 && stripos(print_r($array, true), '*RECURSION*') !== false) return false;

    foreach ($array as $value) {
        if (is_array($value)) {
            $curLevel++;
            if ($curLevel > $maxLevel) $maxLevel++;
            findArrayDepth($value);
            $curLevel--;
        }
    }

    return $maxLevel;
}