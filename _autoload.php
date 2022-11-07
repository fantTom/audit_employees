<?php

declare(strict_types=1);

spl_autoload_register(function ($class_name) {
    include str_replace("App\\", 'src/' , "{$class_name}.php");
});