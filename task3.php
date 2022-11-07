<?php

use App\Logger;

set_include_path(__DIR__);
require '_autoload.php';

Logger::getLogger()->log(Logger::DEBUG, 'Проверка связи');
Logger::getLogger()->log(Logger::INFO, 'Информация', 'Поменялся владелец файла');
Logger::getLogger()->log(Logger::WARNING, 'Не доступный файл');
Logger::getLogger()->log('some_type', 'Нет доступа');
