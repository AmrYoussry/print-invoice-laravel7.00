<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('invoice_number');
            $table->date('invoice_date')->nullable();
            $table->date('due_date')->nullable();
            $table->unsignedBigInteger('customer');
            $table->foreign('customer')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('discount');
            $table->foreign('discount')->references('id')->on('discounts')->onDelete('cascade');
            $table->unsignedBigInteger('rate_vat_tax');
            $table->foreign('rate_vat_tax')->references('id')->on('taxes')->onDelete('cascade');
            $table->decimal('total',8,2);
            $table->string('status',50);
            $table->integer('value_status');
            $table->text('note')->nullable();
            $table->string('user');
            $table->softDeletes();
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
