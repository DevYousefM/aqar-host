<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('subscribe_company_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreignId("company_plan_id")->references("id")->on("company_plans");
            $table->integer("remaining_properties");
            $table->integer("remaining_special");
            $table->integer("remaining_facebook_ads");
            $table->integer("remaining_youtube_ads")->nullable();
            $table->integer("remaining_google_ads")->nullable();
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribe_company_plans');
    }
};
