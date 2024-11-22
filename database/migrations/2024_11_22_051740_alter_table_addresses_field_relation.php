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
        Schema::table('addresses', function (Blueprint $table) {
//            $table->dropColumn('name');
//            $table->dropColumn('region');
            $table->foreignId('delivery_area_id')->constrained('delivery_areas')->after('user_id');
            $table->string('first_name')->after('delivery_area_id');
            $table->string('last_name')->nullable()->after('first_name');;
            $table->string('email')->after('last_name');;
            $table->string('phone')->after('email');;
            $table->string('type')->after('phone');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
//            $table->string('name');
//            $table->string('region');
        });
    }
};
