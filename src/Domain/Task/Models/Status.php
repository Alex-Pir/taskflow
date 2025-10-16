<?php

namespace Domain\Task\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonInterface;

/**
 * @property-read  int $id - ID
 * @property string $name - Название статуса
 * @property string $code - Код статуса
 *
 * @property-read CarbonInterface $created_at - Дата и время создания
 * @property-read CarbonInterface $updated_at - Дата и время изменения
 */
class Status extends Model
{
    public const CREATED = 'created';

    protected $fillable = [
        'name',
        'code'
    ];
}
