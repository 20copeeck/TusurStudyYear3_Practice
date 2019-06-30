<?php
// загрузка автозагрузчика
require_once __DIR__.'/vendor/autoload.php';

// место где будут хранятся шаблоны Twig
$loader = new Twig_Loader_Filesystem(__DIR__.'/views');

// инициализация самого движка
$twig = new Twig_Environment($loader);
?>