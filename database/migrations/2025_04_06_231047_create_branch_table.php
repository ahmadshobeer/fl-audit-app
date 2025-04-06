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
        Schema::create('audit_branch', function (Blueprint $table) {
            $table->id();
            $table->string("doc_number")->unique();
            $table->string("region_id");
            $table->string("region_name");
            $table->string("head_id");
            $table->string("file_path");
            $table->string("tipe");
            $table->string("sop_id")->nullable(true);
            $table->integer("user_id")->nullable(false);

            $table->timestamps();
            $table->softDeletes(); // ini otomatis bikin kolom deleted_at nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_branch');
    }
};
