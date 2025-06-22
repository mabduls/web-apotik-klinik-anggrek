<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('product_transactions', function (Blueprint $table) {
            $table->string('tracking_number')->nullable()->after('is_paid');
        });
    }

    public function down()
    {
        Schema::table('product_transactions', function (Blueprint $table) {
            $table->dropColumn('tracking_number');
        });
    }
};
