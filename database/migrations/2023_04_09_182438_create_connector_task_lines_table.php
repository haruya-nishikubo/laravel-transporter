<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connector_task_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('connector_task_id')
                ->constrained();
            $table->string('source_repository')
                ->comment('Source Repository');
            $table->string('target_repository')
                ->comment('Target Repository');
            $table->string('status')
                ->comment('ステータス');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connector_task_lines');
    }
};
