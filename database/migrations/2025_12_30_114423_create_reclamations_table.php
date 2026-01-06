<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
 public function up()
 {
 Schema::create('reclamations', function (Blueprint $table) {
 $table->id();
 $table->string('titre');
 $table->text('description');
 $table->enum('statut', ['en_attente', 'en_cours', 'resolue', 'fermee'])
 ->default('en_attente');
 $table->enum('priorite', ['basse', 'moyenne', 'haute'])
 ->default('moyenne');
 $table->foreignId('user_id')->constrained()->onDelete('cascade');
 $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
 $table->foreignId('assigned_to')->nullable()
 ->constrained('users')->onDelete('set null');
 $table->timestamps();
 
 // Index pour performance
 $table->index('statut');
 $table->index('priorite');
 $table->index('created_at');
 });
 }
 public function down()
 {
 Schema::dropIfExists('reclamations');
 }
};