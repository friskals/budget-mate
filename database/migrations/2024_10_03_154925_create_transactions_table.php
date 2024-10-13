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
            $table->id();
            $table->string('transaction_id');
            $table->string('category_id');
            $table->string('category_type');
            $table->string('category_logo');
            $table->float('amount');
            $table->float('memo')->nullable();
            $table->date('transaction_date');
            $table->string('user_id');
            $table->string('account_id');
            $table->index(['user_id','category_id','created_at']);
            $table->index(['user_id', 'account_id']);
            $table->timestamps();
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
