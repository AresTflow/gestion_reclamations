<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
 public function up()
 {
 Schema::create('pieces_jointes', function (Blueprint $table) {
 $table->id();
 $table->string('nom_fichier');
 $table->string('chemin');
 $table->foreignId('reclamation_id')->constrained()->onDelete('cascade');
 $table->timestamps();
 });
 }
 public function down()
 {
 Schema::dropIfExists('pieces_jointes');
 }
};