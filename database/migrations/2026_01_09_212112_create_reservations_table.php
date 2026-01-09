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
        Schema::disableForeignKeyConstraints();

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zone_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('customer_name', 120);
            $table->string('customer_phone', 30);
            $table->dateTime('start_at');
            $table->integer('hours')->default(1);
            $table->dateTime('end_at')->nullable();
            $table->decimal('hourly_price', 10, 2);
            $table->decimal('total', 10, 2)->default(0);
            $table->enum('status', ["pendiente","confirmada","cancelada","finalizada"])->default('pendiente');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
