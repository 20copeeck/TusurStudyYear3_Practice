<?php

require_once __DIR__.'/init.php';

// Создаем список сотрудников
$staff = [
    [   'name'    => 'Андрей',
        'description'   => 'Физика',
        'age'           =>  29,
        'date_register' => '2017-06-23',
    ],
    [
        'name'          => 'Татьяна',
        'description'   => 'Химия',
        'age'           =>  25,
        'date_register' => '2017-06-22',
    ],
    [
        'name'          => 'Наталья',
        'description'   => 'Алгебра',
        'age'           =>  27,
        'date_register' => '2017-10-25',
    ],
];

// вывод данных на страницу
echo $twig->render('index.html', ['staff' => $staff] );