<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('return_rentals', function (Blueprint $table) {
            $table->id();
            $table->date('return_date');
            $table->smallInteger('days');
            $table->decimal('cost', 10, 2);
            $table->foreignId('rental_id')->constrained('rentals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_rentals');
    }
};
