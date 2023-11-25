<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('company_banners', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("path");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_banners');
    }
};
