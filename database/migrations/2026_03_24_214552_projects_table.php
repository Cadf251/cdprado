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
        Schema::create('projects', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('api_token')->nullable();
            $table->json("payload");
            $table->string("sync_entry_point");
            $table->string("sync_status");
            $table->timestamp('last_sync_at')->nullable();
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('project_contents', function (Blueprint $table){
            $table->id();
            $table->string("name");
            $table->string("entry_point");
            $table->string("view_link");
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_contents');
    }
};
