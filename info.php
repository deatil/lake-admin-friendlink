<?php

return array(
    'module' => 'lfriendlink',
    'name' => '友情链接',
    'introduce' => '友情链接模块',
    'author' => 'deatil',
    'authorsite' => 'https://github.com/deatil',
    'authoremail' => 'deatil@github.com',
    'version' => '2.0.2',
    'adaptation' => '2.0.2',
    'sign' => '59d2602904b048d22e28a150aa646fc3',
    
    'need_module' => [],
    
    'event' => [],
    
    'menus' => include __DIR__ . '/menu.php',
    
    'tables' => [
        'lfriendlink',
        'lfriendlink_cate',
    ],
);
