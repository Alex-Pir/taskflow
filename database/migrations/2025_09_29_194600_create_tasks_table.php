<?php

use Domain\Task\Models\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->timestamps();
        });

        $this->createStatuses();

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignIdFor(Status::class)
                ->index()
                ->constrained();
            $table->unsignedBigInteger('owner_id')->index();
            $table->unsignedBigInteger('executor_id')->index();
            $table->date('date_end')->nullable();

            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('executor_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('statuses');
    }

    private function createStatuses(): void
    {
        DB::table('statuses')->insert([
            [
                'name' => 'Создана',
                'code' => Status::CREATED,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'В работе',
                'code' => 'in_progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'На проверке',
                'code' => 'test',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Завершена',
                'code' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Отменена',
                'code' => 'canceled',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
};
