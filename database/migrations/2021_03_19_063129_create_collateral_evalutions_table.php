<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollateralEvalutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collateral_evalutions', function (Blueprint $table) {
            $table->id();
            $table->integer('collateral_id');
            $table->integer('loan_id');
            $table->integer('liquidatable_score');
            $table->string('liquidatable_comment');
            $table->integer('market_value');
            $table->string('market_value_comment');
            $table->string('state');
            $table->text('state_comment');
            $table->string('ownership');
            $table->string('ownership_comment');
            $table->integer('user_id');
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
        Schema::dropIfExists('collateral_evalutions');
    }
}
