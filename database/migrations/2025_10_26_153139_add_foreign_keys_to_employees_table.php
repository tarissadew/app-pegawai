<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Tambah kolom foreign key
            if (!Schema::hasColumn('employees', 'department_id')) {
                $table->unsignedBigInteger('department_id')->after('id');
            }

            if (!Schema::hasColumn('employees', 'position_id')) {
                $table->unsignedBigInteger('position_id')->after('department_id');
            }

            // Tambah relasi ke tabel lain
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Hapus foreign key
            $table->dropForeign(['department_id']);
            $table->dropForeign(['position_id']);

            // Hapus kolom
            $table->dropColumn(['department_id', 'position_id']);
        });
    }
};
