<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Auth\Constants\VerificationStatus;
use Modules\Auth\Constants\VerificationType;

class CreateVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->enum('type', [
                VerificationType::TYPE_EMAIL,
                VerificationType::TYPE_PHONE,
            ])->default(VerificationType::TYPE_EMAIL);

            $table->string('value');
            $table->string('code');
            $table->enum('status', [
                VerificationStatus::STATUS_CONFIRM,
                VerificationStatus::STATUS_EXPIRED,
                VerificationStatus::STATUS_SENT,
            ])->default(VerificationStatus::STATUS_SENT);

            $table->timestamps();

            $table->index(['type', 'token']);
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verifications');
    }
}
