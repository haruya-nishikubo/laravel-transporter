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
        Schema::create('connector_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('connector_id')
                ->constrained();
            $table->dateTime('start_cursor_at')
                ->comment('取得データの開始日時');
            $table->dateTime('end_cursor_at')
                ->comment('取得データの終了日時');
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
        Schema::dropIfExists('connector_tasks');
    }
};
