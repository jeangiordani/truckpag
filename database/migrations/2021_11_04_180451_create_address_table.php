<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('public_place');
            $table->string('number');
            $table->string('district');
            $table->timestamps();

            $table->integer('city_id', false, true)->nullable(false);
            // $table->unsignedBigInteger('city_id')->nullable(false);

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('address', function (Blueprint $table) {
        //     $table->dropForeign(['city_id']);
        // });

        Schema::table('address', function (Blueprint $table) {
            /** Make sure to put this condition to check if driver is SQLite */
            if (DB::getDriverName() !== 'sqlite') {
                $table->dropForeign(['city_id']);
            }

            $table->dropColumn(['city_id']);
        });
        Schema::dropIfExists('address');
    }
}
