<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenpaymentsdataRecipientTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('openpaymentsdata_recipient', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openpaymentsdata_reference_id');
            $table->string('name');
            $table->enum('type', ['PROVIDER', 'HOSPITAL']);
            $table->integer('total_number_of_transactions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('openpaymentsdata_recipient');
    }

}
