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
        Schema::create('evenementen_toevoegen', function (Blueprint $table) {
            $table->id();
            $table->string('titel');
            $table->date('datum');
            $table->time('starttijd')->nullable();
            $table->time('eindtijd')->nullable();
            $table->text('beschrijving')->nullable();
            $table->string('locatie');
            $table->integer('aantal_beschikbare_plekken')->nullable();
            $table->string('betaal_link')->nullable();
            $table->string('categorie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenementen_toevoegen');
    }
};
