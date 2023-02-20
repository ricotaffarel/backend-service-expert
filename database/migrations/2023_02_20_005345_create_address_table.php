<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->char('province_code', 2);
            $table->char('city_code', 4);
            $table->char('district_code', 7);
            $table->char('villages_code', 10);
            $table->char('title');
            $table->char('detail_address');
            $table->char('lat');
            $table->char('long');
            $table->timestamps();

            $table->foreign('province_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('city_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('district_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'districts')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('villages_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'villages')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}