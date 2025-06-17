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
      // database/migrations/xxxx_xx_xx_create_notifications_table.php
      Schema::create('notifications', function (Blueprint $table) {
          $table->id();
          $table->foreignId('user_id')->constrained()->onDelete('cascade'); // receiver
          $table->foreignId('from_user_id')->constrained('users')->onDelete('cascade'); // sender
          $table->enum('type', ['like', 'dislike', 'match']);
          $table->boolean('read')->default(false);
          $table->timestamps();
      });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
