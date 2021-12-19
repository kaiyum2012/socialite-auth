<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userModel = config('socialite-auth.user_model');
        Schema::create('social_accounts', function (Blueprint $table) use ($userModel) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references(app($userModel)->getKeyName())->on(app($userModel)->getTable())->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('identifier');
            $table->string('provider', '50');
            $table->string('token')->nullable();
            $table->timestamp('expire_on')->nullable(); // null means no expiry
            $table->json('data')->nullable();
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
        Schema::dropIfExists('social_accounts');
    }
}
