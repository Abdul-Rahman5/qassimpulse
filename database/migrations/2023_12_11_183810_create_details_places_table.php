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
        Schema::create('details_places', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("type");
            $table->text("data");
            $table->string("evaluation");
            $table->string("contact");
            $table->string("link")->nullable();
            $table->string("timeVisit");
            $table->string("images")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_places');
    }
};
