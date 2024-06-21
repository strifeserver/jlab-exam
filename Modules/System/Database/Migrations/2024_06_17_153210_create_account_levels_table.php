<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_levels', function (Blueprint $table) {
            $table->id();
            $table->string('account_level_code')->nullable();
            $table->string('account_level_name')->nullable();
            $table->text('module_store')->nullable();
            $table->text('module_update')->nullable();
            $table->text('module_delete')->nullable();
            $table->text('module_export')->nullable();
            $table->text('module_import')->nullable();
            $table->text('created_by')->nullable();
            $table->text('updated_by')->nullable();
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
        Schema::dropIfExists('account_levels');
    }
}
