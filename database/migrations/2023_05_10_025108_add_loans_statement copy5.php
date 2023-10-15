<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
    DB::unprepared('DROP VIEW IF EXISTS loans_statement_of_accounts');
    
    DB::unprepared("CREATE VIEW loans_statement_of_accounts AS 
        SELECT l.loans_users_id, l.fechanuevoprestamo AS datetrx, l.id, l.created_at, l.updated_at, l.monto, lu.cedula, lu.nombre, 'Prestamo' as loan_type, l.sucursal
        FROM loans l
        INNER JOIN loans_users lu ON l.loans_users_id = lu.id::varchar
        UNION ALL
        SELECT lp.loans_users_id, lp.datepayment AS datetrx, lp.id, lp.created_at, lp.updated_at, lp.amount * (-1), lu.cedula, lu.nombre, 'Pago' as loan_type, lp.sucursal
        FROM loans_payments lp
        INNER JOIN loans_users lu ON lp.loans_users_id = lu.id::varchar
        ORDER BY loans_users_id, datetrx");
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
