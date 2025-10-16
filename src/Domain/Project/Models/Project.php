<?php

namespace Domain\Project\Models;

use Carbon\CarbonInterface;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id - ID проекта
 * @property string $name - Название проекта
 * @property string $code - Код проекта
 *
 * @property-read CarbonInterface $created_at - Дата и время создания
 * @property-read CarbonInterface $updated_at - Дата и время изменения
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code'
    ];

    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }
}
