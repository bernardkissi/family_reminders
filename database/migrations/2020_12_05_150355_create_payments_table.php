<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contribution_id')->unsigned()->index();
            $table->string('tx_ref');
            $table->foreignId('user_id')->index()->nullable()->constrained('users')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('payment_id')->nullable();
            $table->integer('amount');
            $table->string('payment_type')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('contribution_id')->references('id')->on('contributions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
