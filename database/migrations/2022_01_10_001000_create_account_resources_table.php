<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheBachtiarz\AccountResource\Interfaces\Model\AccountResourceInterface;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_resources', function (Blueprint $table) {
            $table->id();
            $table->string(AccountResourceInterface::ATTRIBUTE_CODE)->unique();
            $table->string(AccountResourceInterface::ATTRIBUTE_IDENTIFIER)->nullable();
            $table->text(AccountResourceInterface::ATTRIBUTE_VALUE);
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
        Schema::dropIfExists('account_resources');
    }
};
