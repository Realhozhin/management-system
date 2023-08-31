<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('managementSystem');
            $table->string('company_address')->default('managementSystem address');
            $table->string('company_phone')->default('+99 managementSystem');
            $table->string('company_email')->default('management@System.com');
            $table->string('company_fax')->default('+88 managementSystem');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
