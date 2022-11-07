<?php

declare(strict_types=1);

namespace App;

/**
 * Class Department
 *
 * @property integer $id
 * @property string $name
 */
class Department extends ActiveRecord
{
    static protected string $table = 'departments';

    public function attributes(): array
    {
        return [
            'id',
            'name',
        ];
    }
}
