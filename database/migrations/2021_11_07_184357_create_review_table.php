<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Rate\Constants\RateTypeConstant;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shop')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('rate');
            $table->text('text')->nullable();
            $table->enum('type', [
                RateTypeConstant::RATE_TYPE_GENERAL,
                RateTypeConstant::RATE_TYPE_SERVICE,
                RateTypeConstant::RATE_TYPE_TASTE,
                RateTypeConstant::RATE_TYPE_WAITER
            ])->default(RateTypeConstant::RATE_TYPE_GENERAL);
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
        Schema::dropIfExists('review');
    }
}
