<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // 既存の外部キー制約（products_company_id_foreign）を削除
            $table->dropForeign(['company_id']);

            // 正しい参照先（companies テーブルの id）に外部キーを貼り直す
            $table->foreign('company_id')
                  ->references('id')
                  ->on('companies')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['company_id']);

            $table->foreign('company_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
        });
    }
};