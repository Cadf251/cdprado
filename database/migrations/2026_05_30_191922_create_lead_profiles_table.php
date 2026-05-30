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
        Schema::create('lead_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->unique()->constrained('leads', 'id')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->text('notes')->nullable();
            $table->string('quality')->default('draft'); // ['draft', 'consolidated']
            $table->json('payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_profiles');
    }
};
