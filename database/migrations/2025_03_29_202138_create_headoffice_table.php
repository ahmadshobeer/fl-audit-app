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
        Schema::create('audit_headoffice', function (Blueprint $table) {
            $table->id();
            $table->string("doc_number")->unique();
            $table->string("division_id");
            $table->string("division_name");
            $table->string("head_id");
            $table->string("file_path");
            $table->string("tipe");
            $table->string("sop_id")->nullable(true);
            $table->integer("user_id")->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_headoffice');
    }
};
