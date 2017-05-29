<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', __DIR__ . DS);
define('SRC_PATH', ROOT_PATH . 'src' . DS);

set_include_path(ROOT_PATH);

function autoload($class)
{
    include_once(SRC_PATH . strtr($class . '.php', '\\', DS));
}

spl_autoload_register('autoload');
