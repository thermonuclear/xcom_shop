<?php
/**
 Задание 2. SQL
Необходимо разработать структуру базы данных для каталога товаров.

Используемая СУБД: MySQL.

Условия задачи:
1. Древовидная структура каталога.
2. Товар привязан к одному узлу дерева.
3. Товар имеет: название, артикул, изображение, признак типа товара (напр.: зонтик, телефон и т.д.) и текстовое описание.

Изобразите схему структуры базы данных каталога товаров.
Напишите примеры SQL запросов формирующие:
1. Список товаров одной директории каталога.
2. Список товаров одной директории каталога, включая все подкаталоги.
*/



/**
 * Как хранить в БД древовидные структуры https://github.com/codedokode/pasta/blob/master/db/trees.md
 * Для решения задачи используем способ Nested sets
 */

// коннект к базе
$mysqli = new mysqli("localhost", "root", "", "test");
if ($mysqli->connect_errno) {
    exit("Не удалось подключиться к MySQL: " . $mysqli->connect_error);
}
if (!$mysqli->query("SET NAMES UTF8")) {
    exit($mysqli->connect_error);
}

/**
    Вместо схемы структура таблиц
*/
// создаем таблицу с категориями(директориями) каталога согласно алгоритму Nested sets, если отсутствует
$mysqli->query("CREATE TABLE IF NOT EXISTS category (
      cat_id int(10) unsigned NOT NULL AUTO_INCREMENT,
      cat_name VARCHAR(128) COMMENT 'наименование',
      cat_left int(10),
      cat_right int(10),
      cat_level int(10),
      PRIMARY KEY  (cat_id),
      KEY cat_left (cat_left)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='дерево категорий'
");

// создаем таблицу товаров, если отсутствует
$mysqli->query("CREATE TABLE IF NOT EXISTS product (
      prod_id int(10) unsigned NOT NULL AUTO_INCREMENT,
      prod_cat_id int(10) unsigned COMMENT 'id категории',
      prod_name VARCHAR(256) COMMENT 'наименование',
      prod_article VARCHAR(128) COMMENT 'артикул',
      prod_img VARCHAR(128) COMMENT 'путь к изображению',
      prod_type int(10) COMMENT 'id типа товара',
      prod_descr TEXT COMMENT 'описание',

      PRIMARY KEY  (prod_id),
      KEY prod_cat_id (prod_cat_id),
      FOREIGN KEY (prod_cat_id) REFERENCES category (cat_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='товары'
");


// 1. Список товаров одной директории каталога.
$res = $mysqli->query("SELECT * from product WHERE prod_cat_id=3");
$productsDir = $res->fetch_all(MYSQLI_ASSOC);

// 2. Список товаров одной директории каталога, включая все подкаталоги.
$res = $mysqli->query("SELECT * from product JOIN category ON product.prod_cat_id=category.cat_id WHERE category.cat_left>=2 AND category.cat_left<=9");
$productsAllDir = $res->fetch_all(MYSQLI_ASSOC);