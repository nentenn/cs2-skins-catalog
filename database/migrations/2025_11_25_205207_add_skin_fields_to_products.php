<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            if (!Schema::hasColumn('products', 'rarity')) {
                $table->string('rarity')->nullable();
            }

            if (!Schema::hasColumn('products', 'quality')) {
                $table->string('quality')->nullable();
            }

            if (!Schema::hasColumn('products', 'stattrak')) {
                $table->boolean('stattrak')->default(false);
            }

        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'rarity')) {
                $table->dropColumn('rarity');
            }
            if (Schema::hasColumn('products', 'quality')) {
                $table->dropColumn('quality');
            }
            if (Schema::hasColumn('products', 'stattrak')) {
                $table->dropColumn('stattrak');
            }
        });
    }
};
