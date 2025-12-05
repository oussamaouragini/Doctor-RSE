<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('specialty')->after('name');
            $table->string('address')->after('specialty');
            $table->boolean('is_eco_friendly')->default(false)->after('address');
            $table->boolean('is_local_business')->default(false)->after('is_eco_friendly');
            $table->boolean('is_accessible')->default(true)->after('is_local_business');
            $table->integer('rse_score')->default(50)->after('is_accessible');
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['specialty','address','is_eco_friendly','is_local_business','is_accessible','rse_score']);
        });
    }
};
