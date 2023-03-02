<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peek_request_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('action');
            $table->integer('duration');
            $table->json('headers');
            $table->integer('memory');
            $table->string('method');
            $table->string('path');
            $table->json('payload');
            $table->integer('status');
            $table->string('url');
            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peek_request_records');
    }
};
