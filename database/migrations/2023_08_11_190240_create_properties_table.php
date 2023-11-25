<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id()->startingValue(100);
            $table->foreignUlid("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->string("title");
            $table->longText("brief");
            $table->string("type");
            $table->string("purpose");
            $table->string("gov");
            $table->string("area");
            $table->string("level");
            $table->integer("rooms");
            $table->integer("meters");
            $table->string("payment");
            $table->integer("presenter")->nullable();
            $table->integer("price")->nullable();
            $table->boolean("is_special")->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
