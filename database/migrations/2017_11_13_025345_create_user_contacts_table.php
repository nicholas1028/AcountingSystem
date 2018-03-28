<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contacts', function (Blueprint $table) {

            $table->increments('id');

            $table->unsignedInteger('team_id')->nullable(); //renamed to team from company
            $table->unsignedInteger('open_id')->nullable(); //

            $table->string('name')->nullable(); //organization name
            $table->string('email')->nullable();
            $table->string('emails')->nullable();

            $table->string('image')->nullable();

            $table->string('phone')->nullable();
            $table->string('contact1')->nullable();
            $table->string('contact2')->nullable();

            $table->string('currency_id',3)->nullable();
            $table->unsignedInteger('payment_terms')->default(1);

            $table->string('bill_address1')->nullable();
            $table->string('bill_address2')->nullable();
            $table->string('bill_city')->nullable();
            $table->string('bill_state')->nullable();
            $table->string('bill_postal_code')->nullable();
            $table->string('bill_country_id',3)->nullable();

            $table->string('ship_phone')->nullable();   //new fields
            $table->string('ship_contact')->nullable(); //new fields
            $table->string('ship_address1')->nullable();
            $table->string('ship_address2')->nullable();
            $table->string('ship_city')->nullable();
            $table->string('ship_state')->nullable();
            $table->string('ship_postal_code')->nullable();
            $table->string('ship_country_id',3)->nullable();
            $table->string('instructions')->nullable();

            $table->string('account_no')->nullable();
            $table->string('id_no')->nullable();
            $table->string('vat_no')->nullable();
            $table->string('gst_code')->nullable(); //client gstn number

            $table->string('fax_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('toll_free_no')->nullable();
            $table->string('website')->nullable();

            //$table->decimal('balance', 13, 2)->default(0);

            $table->unsignedInteger('created_by_id')->nullable();
            $table->unsignedInteger('modified_by_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_contacts');
    }
}
