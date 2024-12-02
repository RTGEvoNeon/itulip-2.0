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
    Schema::table('order_details', function (Blueprint $table) {
        $table->integer('count')->change(); // Меняем на integer
    });
}

public function down()
{
    Schema::table('order_details', function (Blueprint $table) {
        $table->decimal('count', 8, 2)->change(); // Возвращаем обратно на decimal
    });
}


};
