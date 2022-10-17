<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
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
            $table->string('title_first_letter')->nullable();
            $table->string('title_remain_letter')->nullable();
            $table->string('title_sort_desc');
            $table->string('hero_title');
            $table->string('hero_designation');
            $table->string('hero_sort_desc');
            $table->string('hero_image');
            $table->string('hero_image_folder_id');
            $table->string('site_logo')->nullable();
            $table->string('logo_folder_id')->nullable();
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
}
