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
        Schema::create('thuctap', function (Blueprint $table) {
            $table->id();
            $table->string('ten_khoathuctap', 255);
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->unsignedBigInteger('sinhvien_id');
            $table->foreign('sinhvien_id')->references('id')->on('sinhvien')->onDelete('cascade');
            $table->unsignedBigInteger('giangvien_id');
            $table->foreign('giangvien_id')->references('id')->on('giangvien')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khoathuctap');
    }
};
