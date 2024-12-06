<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('disciplinas', function (Blueprint $table) {
            $table->dropForeign(['curso_id']);
            $table->dropColumn('curso_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('disciplinas', function (Blueprint $table) {
            $table->foreignId('curso_id')->constrained()->onDelete('cascade');
        });
    }
};
