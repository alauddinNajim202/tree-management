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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_hot_deal')->default(false)->after('is_featured');
            $table->boolean('is_special_offer')->default(false)->after('is_hot_deal');
            $table->dateTime('deal_end_date')->nullable()->after('is_special_offer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_hot_deal', 'is_special_offer', 'deal_end_date']);
        });
    }
};
