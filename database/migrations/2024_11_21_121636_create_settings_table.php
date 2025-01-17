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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->longText('description')->nullable();
            $table->text('name')->nullable();
            $table->string('logo')->nullable();
            $table->string('fev')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('copy_right')->nullable();
            $table->longText('about')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('shipping_policy')->nullable();
            $table->longText('terms_policy')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('fblink')->nullable();
            $table->string('ytlink')->nullable();
            $table->string('ilink')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
