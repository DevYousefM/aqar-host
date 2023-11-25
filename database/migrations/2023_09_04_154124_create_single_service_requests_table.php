<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('single_service_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreignId("single_service_id")->references("id")->on("single_services");
            $table->string("status")->default("process");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('single_service_requests');
    }
};
