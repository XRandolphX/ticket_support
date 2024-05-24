<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_department', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // Inserta los datos iniciales
        DB::table('user_department')->insert([
            ['department' => 'DIRECCIÓN'],
            ['department' => 'TRÁMITE DOCUMENTARIO'],
            ['department' => 'IMAGEN INSTITUCIONAL'],
            ['department' => 'UNIDAD DE PLANEAMIENTO Y DESARROLLO INSTITUCIONAL'],
            ['department' => 'UNIDAD DE ASESORIA JUR;IDICA'],
            ['department' => 'UNIDAD DE EDUCACIÓN BÁSICA TECNICO PRODUCTIVA'],
            ['department' => 'UNIDAD DE ADMINISTRACIÓN'],
            ['department' => 'TESORERÍA'],
            ['department' => 'CONTABILIDAD'],
            ['department' => 'INFRAESTRUCTURA'],
            ['department' => 'PATRIMONIO'],
            ['department' => 'ABASTECIMIENTO'],
            ['department' => 'ALMACÉN'],
            ['department' => 'PERSONAL'],
            ['department' => 'REMUNERACIONES'],
            ['department' => 'INFORMÁTICA'],
            ['department' => 'COMISION DE PROCESOS ADMINISTRATIVOS DOCENTES'],
            ['department' => 'ESCALAFON'],
            ['department' => 'PROGRAMA PRESUPUESTAL REDUCCIÓN DE LA VULNERABILIDAD Y ATENCIÓN DE EMERGENCIAS POR DESASTRES'],
            ['department' => 'CONSTANCIA DE PAGO'],
            ['department' => 'SALA 30%'],
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_department');
    }
};
