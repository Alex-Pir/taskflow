<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->unique();
            $table->timestamps();
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id')->nullable()->after('id');
            $table->foreign('project_id')->references('id')->on('projects');
        });

        $this->createProjectForOldTasks();

        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id')->nullable(false)->change();
        });
    }

    private function createProjectForOldTasks(): void
    {
        $projectId = DB::table('projects')->insertGetId([
            'title' => 'Project 1',
            'code' => 'project-1',
        ]);

        DB::table('tasks')->chunkById(100, function (Collection $tasks) use ($projectId) {
            foreach ($tasks as $task) {
                DB::table('tasks')->where('id', $task->id)->update(['project_id' => $projectId]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('project_id');
        });
        Schema::dropIfExists('projects');
    }
};
