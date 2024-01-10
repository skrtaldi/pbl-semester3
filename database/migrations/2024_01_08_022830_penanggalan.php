<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class penanggalan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penanggalan', function (Blueprint $table) {
            $table->id();  // Membuat kolom ID otomatis
            $table->date('tanggal');  // Membuat kolom tanggal dengan tipe data date
            $table->timestamps();  // Opsional: Menambahkan created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penanggalan');
    }
}
