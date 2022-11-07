<?php

declare(strict_types=1);

namespace App;

use Exception;

/**
 * debug — Подробная информация для отладки
 * info — Интересные события
 * notice — Существенные события, но не ошибки
 * warning — Исключительные случаи, но не ошибки
 * error — Ошибки исполнения, не требующие сиюминутного вмешательства
 * critical — Критические состояния (компонент системы недоступен, неожиданное исключение)
 * alert — Действие требует безотлагательного вмешательства
 * emergency — Система не работает
 */
class Logger
{
    public const DEBUG = 'debug';
    public const INFO = 'info';
    public const NOTICE = 'notice';
    public const WARNING = 'warning';
    public const ERROR = 'error';
    public const CRITICAL = 'critical';
    public const ALERT = 'alert';
    public const EMERGENCY = 'emergency';

    protected const LOG_TYPES = [
        self::DEBUG,
        self::INFO,
        self::NOTICE,
        self::WARNING,
        self::ERROR,
        self::CRITICAL,
        self::ALERT,
        self::EMERGENCY,
    ];

    protected static $loggers = [];

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    public static function getLogger()
    {
        $cls = static::class;
        if (!isset(self::$loggers[$cls])) {
            self::$loggers[$cls] = new static();
        }

        return self::$loggers[$cls];
    }

    public function log(string $type, string $message)
    {
        if (!in_array($type, self::LOG_TYPES)) {
            $this->selfLog();
        }

        $log = '[' . mb_strtoupper($type) . '] ';
        $log .= '[' . date('D M d H:i:s Y', time()) . '] ';

        if (func_num_args() > 2) {
            $params = func_get_args();
            $message .= ' ';
            $message .= implode('. ', array_slice($params, 2));
        }

        $log .= $message;
        $log .= PHP_EOL;

        file_put_contents($this->getPatch(), $log, FILE_APPEND);
    }

    private function getPatch(): string
    {
        $patch = dirname(__DIR__, 1);
        $name = date('Y-m-d');
        return $patch . '/' . $name . '.log';
    }

    private function selfLog()
    {
        self::getLogger()->log(self::WARNING, 'Неизвестный тип логирования.');
    }
}
