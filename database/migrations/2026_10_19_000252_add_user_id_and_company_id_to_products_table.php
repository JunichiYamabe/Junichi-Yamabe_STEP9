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
        Schema::table('products', function (Blueprint $table) {
            //user_idカラムの追加(FK)
             $table ->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
             //company_idカラムの追加(FK)
             $table ->foreignId('company_id')->after('user_id')->constrained('products')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //先にFK制約を外す
            $table->dropForeign(['user_id']);
            $table->dropForeign(['product_id']);
            //カラム削除
            $table->dropColumn(['user_id', 'company_id']);            
        });
    }
};
