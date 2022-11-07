<?php

declare(strict_types=1);

namespace App;

abstract class ActiveRecord
{
    private $conn;
    static protected string $table;

    abstract public function attributes();

    public function __construct()
    {
        $conf = include('config.php');

        $db = new Db($conf['db_name']);
        $this->conn = $db->connect();
    }

    public function load($values)
    {
        if (is_array($values)) {
            $attributes = $this->attributes();
            foreach ($values as $name => $value) {
                if (in_array($name, $attributes)) {
                    $this->$name = trim($value);
                }
            }
        }
    }

    public function query()
    {
        return $this->conn->query(static::createSql());
    }

    public static function createSql(): string
    {
        $table = static::$table;
        return "SELECT * FROM {$table}";
    }

    public function save(): bool
    {
        $attributes = $this->attributes();

        $this->validate();

        $data = [];
        foreach ($attributes as $name) {
            if (!empty($this->$name)) {
                $data[$name] = $this->$name;
            }
        }

        $fields = implode(', ', $attributes);
        $values = implode(', :', $attributes);
        $table = static::$table;
        $sql = "INSERT INTO {$table} ({$fields}) VALUES (:{$values})";

        return $this->conn->prepare($sql)->execute($data);
    }

    public function validate()
    {
        return;
    }
}
