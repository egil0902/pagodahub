<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            "Create OR REPLACE VIEW loans_statement_of_accounts as 
        SELECT 
        l.loans_users_id,
        l.fechanuevoprestamo as datetrx,
        l.id,
        l.created_at,
        l.updated_at,
        l.monto,
        lu.cedula,
        lu.nombre,
        'Prestamo' as loan_type,
        l.firmanuevoprestamo AS signatures,
        l.filecedula AS files
        FROM loans l inner join loans_users lu on l.loans_users_id=lu.id::varchar
        UNION ALL
        SELECT 
        lp.loans_users_id,
        lp.datepayment as datetrx,lp.id,
        lp.created_at, lp.updated_at,
        lp.amount*(-1),
        lu.cedula,lu.nombre,
        'Pago' as loan_type,
        lp.signature AS signatures,
        lp.file AS files
        FROM loans_payments lp inner join loans_users lu on lp.loans_users_id=lu.id::varchar order by loans_users_id,datetrx;"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
