<?php

declare(strict_types=1);

namespace App;

use PDO;
use SQLite3;

class Db
{
    private $pdo;
    private string $dbName;

    public function __construct(string $dbName, bool $demoData = true)
    {
        if (!file_exists($dbName)) {
            Db::init($dbName, $demoData);
        }
        $this->dbName = $dbName;
    }

    public function connect(): PDO
    {
        if ($this->pdo == null) {
            try {
                $this->pdo = new PDO("sqlite:" . $this->dbName);
            } catch (\PDOException $e) {
                print_r($e->getMessage());
                die;
            }
        }
        return $this->pdo;
    }

    public static function init(string $dbName, bool $data)
    {
        $db = new SQLite3($dbName);

        $db->exec('CREATE TABLE departments(
                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                            name TEXT NOT NULL    
                        )
        ');
        $db->exec('CREATE TABLE positions(
                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                            name TEXT NOT NULL 
                        )
        ');
        $db->exec('CREATE TABLE addresses(
                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                            description TEXT NOT NULL
                        )
        ');

        $db->exec('CREATE TABLE employees(
                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                            first_name TEXT NOT NULL,
                            last_name TEXT NOT NULL,
                            patronymic TEXT,
                            phone_number CHAR(16)  NOT NULL,
                            department_id INTEGER  NOT NULL,
                            position_id INTEGER  NOT NULL,
                            address_id INTEGER  NOT NULL,
                            UNIQUE(department_id, position_id),
                            FOREIGN KEY (department_id)  REFERENCES departments (id) ON DELETE SET NULL,
                            FOREIGN KEY (position_id)  REFERENCES positions (id) ON DELETE SET NULL,
                            FOREIGN KEY (address_id)  REFERENCES addresses (id) ON DELETE SET NULL                            
                         )
        ');

        if ($data) {
            $db->exec("INSERT or REPLACE INTO departments(name) VALUES ('Правое подразделение'), ('Среднее подразделение'), ('Левое подразделение')");
            $db->exec("INSERT or REPLACE INTO positions(name) VALUES ('Менеджер'), ('Старший рабочий'), ('Рабочий'), ('Младший рабочий')");
            $db->exec("INSERT or REPLACE INTO addresses(description) VALUES ('Минск, ул. Могилевская'), ('Минск, ул. Острошицкая'), ('Брест, ул. Советская'), ('Гродно, ул. Ленина')");
            $db->exec("INSERT or REPLACE INTO employees(
                      first_name, last_name, patronymic, phone_number, department_id, position_id, address_id
                      ) VALUES 
                      ('Василий', 'Васильев', 'Васильевич', '+375 29 551 45 54', 1, 1, 1),
                      ('Иван', 'Иванов', '', '+375 29 651 65 64', 1, 3, 2),
                      ('Степан', 'Степанов', 'Степанович', '+375 29 751 75 74', 1, 4, 1),
                      ('Николай', 'Мышкин', '', '+375 29 851 85 84', 2, 1, 3),
                      ('Виктор', 'Мукович', '', '+375 33 351 55 44', 2, 3, 3),
                      ('Винтик', 'Серков', 'Альфрэдович', '+375 33 581 56 24', 2, 4, 3),
                      ('Виталий', 'Семиногов', 'Николаевич', '+375 25 816 46 66', 3, 1, 4),
                      ('Виниамин', 'Безухов', 'Владимирович', '+375 29 316 76 65', 3, 2, 4),
                      ('Вальтер', 'Пухов', '', '+375 33 388 48 12', 3, 4, 4)
            ");
        }
    }
}
