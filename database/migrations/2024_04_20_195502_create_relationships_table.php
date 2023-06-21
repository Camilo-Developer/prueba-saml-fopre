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
        Schema::table('states', function ($table) {
            $table->foreign('type_state_id')->references('id')->on('type_states')->onUpdate('cascade');
        });
        Schema::table('users', function ($table) {
            $table->foreign('estado_id')->references('id')->on('states')->onUpdate('cascade');
        });
        Schema::table('products', function ($table) {
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
        });
        Schema::table('sale_reports', function ($table) {
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade');
        });
        Schema::table('companies', function ($table) {
            $table->foreign('usuario_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('estado_id')->references('id')->on('states')->onUpdate('cascade');
        });
        Schema::table('pre_orders', function ($table) {
            $table->foreign('usuario_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('estado_id')->references('id')->on('states')->onUpdate('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade');
        });
        Schema::table('modalities', function ($table) {
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
        });
        Schema::table('pre_order_product', function ($table) {
            $table->foreign('pre_order_id')->references('id')->on('pre_orders')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
        });
        Schema::table('pay_sale_report', function ($table) {
            $table->foreign('sale_report_id')->references('id')->on('sale_reports')->onDelete('cascade');
            $table->foreign('pay_id')->references('id')->on('pays')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relationships');
    }
};
