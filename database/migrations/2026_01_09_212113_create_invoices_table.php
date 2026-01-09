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

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->cascadeOnDelete()->unique();
            $table->string('invoice_number', 40)->unique();
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('taxes', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->enum('status', ["pendiente","pagada","anulada"])->default('pendiente');
            $table->enum('payment_method', ["efectivo","tarjeta","transferencia","pse"])->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->string('pdf_path', 255)->nullable();
            $table->json('payload')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
