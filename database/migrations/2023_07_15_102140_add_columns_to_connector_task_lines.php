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
            $table->json('source_repository_attributes')
                ->nullable()
                ->after('source_repository');
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
                'source_repository_attributes',
            ]);
        });
    }
};
