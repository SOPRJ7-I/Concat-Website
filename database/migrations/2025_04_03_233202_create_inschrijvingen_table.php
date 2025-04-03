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
        Schema::create('inschrijvingen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->change(); // ;
            $table->foreignId('evenement_id')->constrained('evenementen')->onDelete('cascade');
            $table->string('naam');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('inschrijvingen', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->change(); // Zet terug naar verplicht
        });
    }
};
