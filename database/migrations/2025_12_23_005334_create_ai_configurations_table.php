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
        Schema::create('ai_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('trading_pair')->default('EURUSD');
            $table->enum('strategy_mode', ['SMC', 'ICT', 'Price Action', 'Hybrid'])->default('Hybrid');
            $table->enum('risk_mode', ['Safe', 'Moderate', 'Aggressive', 'Capital Protection'])->default('Moderate');
            $table->boolean('auto_sl_tp')->default(true);
            $table->boolean('news_reaction')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_configurations');
    }
};
