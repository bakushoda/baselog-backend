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
        Schema::table('games', function (Blueprint $table) {
            for ($inning = 1; $inning <= 9; $inning++) {
                $table->integer("home_inning_{$inning}")->nullable();
                $table->integer("away_inning_{$inning}")->nullable();
            }

            //合計得点、合計安打数、合計エラー数
            $table->integer('home_total_score')->nullable();
            $table->integer('away_total_score')->nullable();
            $table->integer('home_total_hits')->nullable();
            $table->integer('away_total_hits')->nullable();
            $table->integer('home_total_errors')->nullable();
            $table->integer('away_total_errors')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            for ($inning = 1; $inning <= 9; $inning++) {
                $table->dropColumn("home_inning_{$inning}");
                $table->dropColumn("away_inning_{$inning}");
            }

            $table->dropColumn('home_total_score');
            $table->dropColumn('away_total_score');
            $table->dropColumn('home_total_hits');
            $table->dropColumn('away_total_hits');
            $table->dropColumn('home_total_errors');
            $table->dropColumn('away_total_errors');
        });
    }
};
