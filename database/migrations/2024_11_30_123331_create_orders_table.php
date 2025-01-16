<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('subtotal');
            $table->string('total');
            $table->string('selling_price');
            $table->string('name');
            $table->string('phone');
            $table->text('address');
            $table->string('city');
            $table->text('note')->nullable();
            $table->string('type')->default('home');
            $table->enum('status',['ordered','booked','delivered','returned','canceled'])->default('ordered');
            $table->boolean('is_shipping_different')->default(false);
            $table->enum('payment_status',['pending','paid'])->default('pending');
            $table->date('delivered_date')->nullable();
            $table->date('paid_date')->nullable();
            $table->date('canceled_date')->nullable();
            $table->date('reutrned_date')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
};
