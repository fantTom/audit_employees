<?php

declare(strict_types=1);

namespace App;

/**
 * Class Position
 *
 * @property integer $id
 * @property string $name
 */
class Position extends ActiveRecord
{
    static protected string $table = 'positions';

    public function attributes(): array
    {
        return [
            'id',
            'name',
        ];
    }
}
