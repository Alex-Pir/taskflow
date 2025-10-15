<?php

namespace Domain\Task\Models;

use Carbon\CarbonInterface;
use Database\Factories\TaskFactory;
use Domain\Project\Models\Project;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read  int $id - ID
 * @property int $project_id - ID проекта
 * @property string $title - Название задачи
 * @property string $description - Описание задачи
 * @property int $status_id - ID статуса задачи
 * @property int $owner_id - ID создателя задачи
 * @property int $executor_id - ID исполнителя задачи
 * @property CarbonInterface $date_end - Дата завершения задачи
 * @property Project $project - Проект
 * @property Status $status - Статус задачи
 * @property User $owner - Пользователь, создавший задачу
 * @property User $executor - Исполнитель задачи
 *
 * @property-read CarbonInterface $created_at - Дата и время создания
 * @property-read CarbonInterface $updated_at - Дата и время изменения
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status_id',
        'executor_id',
        'date_end',
    ];

    protected $casts = [
        'date_end' => 'date',
    ];

    /**
     * @return BelongsTo<Status, $this>
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function executor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'executor_id', 'id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public static function newFactory(): TaskFactory
    {
        return TaskFactory::new();
    }
}
