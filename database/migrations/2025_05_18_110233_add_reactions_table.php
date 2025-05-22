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
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->string('reaction_type_id')->nullable(false);
            $table->foreign('reaction_type_id')
                  ->references('name')
                  ->on('reaction_types');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('reactionable_id');
            $table->string('reactionable_type')->nullable(false);
            $table->timestamp('created_at')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
