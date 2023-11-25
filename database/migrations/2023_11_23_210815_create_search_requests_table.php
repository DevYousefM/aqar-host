<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('search_requests', function (Blueprint $table) {
            $table->id();
            $table->string("type");
            $table->integer("meters");
            $table->string("gov");
            $table->string("area");
            $table->integer("rooms")->nullable();
            $table->string("contract_type");
            $table->bigInteger("price");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('search_requests');
    }
};
