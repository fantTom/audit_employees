<?php

declare(strict_types=1);

namespace App;

/**
 * Class Employee
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 * @property string $phone_number
 * @property integer $department_id
 * @property integer $position_id
 * @property integer $address_id
 */
class Employee extends ActiveRecord
{
    static protected string $table = 'employees';

    public function attributes(): array
    {
        return [
            'id',
            'first_name',
            'last_name',
            'patronymic',
            'phone_number',
            'department_id',
            'position_id',
            'address_id',
        ];
    }

    public function fields(): array
    {
        return [
            'id' => 'ID',
            'employee_name' => 'ФИО',
            'department' => 'Подразделение',
            'phone' => 'Номер телефона',
            'position' => 'Должность',
            'address' => 'Адрес',
        ];
    }

    public static function createSql(): string
    {
        $table = self::$table;
        return "SELECT 
                        e.id,
                        (e.last_name || ' ' || e.first_name || ' ' || e.patronymic) AS employee_name,
                        e.phone_number as phone,
                        d.name as department,
                        p.name as position,
                        a.description as address
                FROM {$table} e
                LEFT JOIN departments d on e.department_id = d.id
                LEFT JOIN positions p on e.position_id = p.id
                LEFT JOIN addresses a on e.address_id = a.id";
    }
}
