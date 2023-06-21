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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa');//listo
            $table->string('imagen_company')->nullable();//listo
            $table->bigInteger('usuario_id')->unsigned();//listo
            $table->bigInteger('estado_id')->unsigned();//listo

            $table->string('nit')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('direccion_correspondencia')->nullable();
            $table->string('correo_correspondencia')->nullable();
            $table->string('celular_correspondencia')->nullable();
            $table->string('ubicacion')->nullable();//solo admin
            $table->string('logo')->nullable();//listo
            //Vincular como proveedor
            $table->string('comprobante_registro')->nullable();//listo
            //Documentos Sanitarios
            $table->string('registro_invima')->nullable();//listo
            $table->string('examen_microbiologico')->nullable();//listo
            $table->string('bpm')->nullable();//listo
            $table->string('formato_sgsst')->nullable();//listo
            $table->string('protocolos_bioseguridad')->nullable();//listo
            $table->string('plan_saneamiento')->nullable();//listo
            $table->string('copia_carnet_manipulacion')->nullable();//listo
            $table->string('copia_carnet_vacunacion')->nullable();//listo
            $table->string('copia_plantilla_arp')->nullable();//listo
            //Productos
            $table->string('productos')->nullable();//listo
            //REQUERIMIENTOS LOGÍSTICOS Y TÉCNICOS
            $table->longText('logistico')->nullable();
            $table->longText('electrico')->nullable();
            $table->string('gas')->nullable();
            $table->string('carpa')->nullable();
            $table->string('tamaño_carpa')->nullable();
            $table->string('observaciones')->nullable();
            $table->longText('array_medios_pago')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
