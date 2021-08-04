<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoice_code');
            $table->integer('customer_id');
            $table->integer('doctor_id');
            $table->integer('user_id');
            $table->date('pickup_date');
            $table->string('status')->default('pending');
            $table->string('payment_way');
            $table->float('paied');
            $table->float('remaining');
            $table->float('total');
            $table->text('notes')->nullable();
            $table->string('tray_number')->nullable();
            $table->string('return_reason')->nullable();
            $table->string('discount_type')->nullable();
            $table->float('discount_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
