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
        Schema::create('connectors', function (Blueprint $table) {
            $table->id();
            $table->string('name')
                ->comment('コネクタ名');
            $table->foreignId('source_node_id')
                ->constrained('nodes');
            $table->foreignId('target_node_id')
                ->constrained('nodes');
            $table->integer('interval')
                ->comment('同期間隔[h]');
            $table->dateTime('next_start_cursor_at')
                ->comment('次のデータ取得範囲:開始日時');
            $table->dateTime('next_end_cursor_at')
                ->comment('次のデータ取得範囲:終了日時');
            $table->boolean('is_enabled')
                ->default(false)
                ->comment('無効 / 有効');
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
        Schema::dropIfExists('connectors');
    }
};
