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
        Schema::table('pizzas', function (Blueprint $table) {
            $table->string("name_ru")->after('name');
            $table->string("description_ru")->after('description');
        });


        Schema::table('pizza_cats', function (Blueprint $table){
            $table->string("name_ru")->after('name');
            $table->string("description_ru")->after('description');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_tables', function (Blueprint $table) {
            //
        });
    }
};