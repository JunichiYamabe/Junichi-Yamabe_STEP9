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
        Schema::table('users', function (Blueprint $table) {
            //name カラムの後ろに name_kanji カラムを追加
            $table->string('name_kanji')->after('name');
            //name_kanji カラムの後ろに name_kana カラムを追加
            $table->string('name_kana')->after('name_kanji');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['name_kanji', 'name_kana']);
        });
    }
};
