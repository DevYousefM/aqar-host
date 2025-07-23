<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->ulid("id")->primary();
            $table->string('name');
            $table->string("image");
            $table->string("company_name")->nullable();
            $table->string("company_brief")->nullable();
            $table->string("company_type")->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('phone_sec')->unique()->nullable();
            $table->string("location")->nullable();
            $table->string('password');
            $table->integer("property_charge");
            $table->timestamp('email_verified_at')->nullable();
            $table->string("account_type");
            $table->boolean("is_important")->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
