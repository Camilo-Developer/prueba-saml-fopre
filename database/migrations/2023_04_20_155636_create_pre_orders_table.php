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
        Schema::create('pre_orders', function (Blueprint $table) {
            $table->id();
            $table->string('fecha');
            $table->string('dependence');
            $table->string('cost_center');
            $table->string('name_cost_center');
            $table->string('name_auth');
            $table->string('extension');
            $table->string('fecha_claim');
            $table->string('observations');
            $table->unsignedInteger('total');
            $table->bigInteger('usuario_id')->unsigned();
            $table->bigInteger('estado_id')->unsigned();
            $table->bigInteger('company_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_orders');
    }
};
