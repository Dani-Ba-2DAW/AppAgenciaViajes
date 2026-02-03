<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('country', 100);
            $table->foreignId('type_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacations');
    }
};
