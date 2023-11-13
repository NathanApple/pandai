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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("product_point_id");
            $table->integer("quantity");
            $table->integer("total");
            $table->text("payment_url")->nullable();
            $table->string("status", 255);
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('product_point_id')->on('point_products')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
