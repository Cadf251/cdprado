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
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url'); // O site do clietne
            $table->string('title');
            $table->text('about');
            $table->float('relevance')->default(0);
            $table->string('area_atuacao'); // O 'nicho' (advogados, engenharia)
            $table->string("area_atuacao_slug"); // O slug que vai no portfólio
            $table->json('badges')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('portfolio_items');
    }
};
