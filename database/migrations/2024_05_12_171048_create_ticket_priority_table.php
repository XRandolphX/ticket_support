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
        Schema::create('ticket_priority', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_priority_name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // Inserta los datos iniciales
        DB::table('ticket_priority')->insert([
            ['ticket_priority_name' => 'Emergencia'],
            ['ticket_priority_name' => 'Alta'],
            ['ticket_priority_name' => 'Normal'],
            ['ticket_priority_name' => 'Baja'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('priority_ticket');
    }
};
