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
        Schema::create('connector_task_line_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('connector_task_line_id')
                ->constrained();
            $table->string('label')
                ->comment('ラベル');
            $table->json('message')
                ->comment('メッセージ');
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
        Schema::dropIfExists('connector_task_line_logs');
    }
};
