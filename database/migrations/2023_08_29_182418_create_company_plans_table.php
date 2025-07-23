<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('company_plans', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("property_num");
            $table->integer("special_property_num");
            $table->integer("facebook_ads_num");
            $table->integer("header_appear_days")->nullable();
            $table->integer("slider_appear_days")->nullable();
            $table->integer("youtube_ads_num")->nullable();
            $table->integer("google_ads_num")->nullable();
            $table->integer("price");
            $table->integer("last_price");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_plans');
    }
};
