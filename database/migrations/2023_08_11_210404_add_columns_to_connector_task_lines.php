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
        Schema::table('connector_task_lines', function (Blueprint $table) {
            $table->after('connector_task_id', function ($table) {
                $table->foreignId('parent_connector_task_line_id')
                    ->nullable()
                    ->constrained('connector_task_lines');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('connector_task_lines', function (Blueprint $table) {
            $table->dropColumn([
                'parent_connector_task_line_id',
            ]);
        });
    }
};
