<?php
return [
   'site' => 'http://frontend.imagecorp.localhost',
   'admin' => 'http://backend.imagecorp.localhost',
   'typeImage' => [
       'config' => [
           'url' => 'http://frontend.imagecorp.localhost/uploads/',
           'src' => dirname(dirname(__DIR__)).'/frontend/web/uploads/',
           'prefixName' => 'image_',
       ],
       'name' => [
           1 => 'Общие картинки',
           2 => 'Тесты',
           3 => 'Слайдер',
           4 => 'Блог',
       ],
       'system' => [
           1 => 'images',
           2 => 'tests',
           3 => 'slide',
           4 => 'blog',
       ],
       'key' => [
           'images' => 1,
           'tests' => 2,
           'slide' => 3,
           'blog'  => 4,
       ]
   ],
];