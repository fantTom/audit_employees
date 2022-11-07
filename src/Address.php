<?php

declare(strict_types=1);

namespace App;

/**
 * Class Address
 *
 * @property integer $id
 * @property string $description
 */
class Address extends ActiveRecord
{
    static protected string $table = 'addresses';

    public function attributes(): array
    {
        return [
          'id',
          'description',
        ];
    }
}
