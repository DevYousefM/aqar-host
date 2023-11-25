<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_plans_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_plan_id")->references("id")->on("user_plans")->cascadeOnDelete();
            $table->foreignId("property_id")->references("id")->on("properties")->cascadeOnDelete();
            $table->date("start_date")->nullable();
            $table->date("expire_date")->nullable();
            $table->string("status");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_plans_requests');
    }
};
